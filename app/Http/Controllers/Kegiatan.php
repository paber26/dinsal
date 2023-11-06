<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Kegiatan extends Controller
{
    public function getkegiatan($idp){
        $daftarkegiatan = DB::table('kegiatan')->where('idp', $idp)->get();

        return $daftarkegiatan;
    }

    public function getdetailkegiatan($idk){
        $detailkegiatan = DB::table('kegiatan')->select('kegiatan.*', 'proyek.nama as proyeknama')
        ->where('kegiatan.idk', $idk)->leftjoin('proyek', 'kegiatan.idp', '=', 'proyek.idp')->first();
        return $detailkegiatan;
    }
    
    public function getkegiatanfilter($idp, $status){
        $daftarkegiatan = DB::table('kegiatan')->where(['idp' => $idp, 'status' => $status])->get();
        
        return $daftarkegiatan;
    }

    public function tambahkan(Request $request){
        $kegiatan = [
            'idp' => $request->proyekid,
            'nama' => $request->kegiatan,
            'link' => $request->link,
            'shortlink' => $request->shortlink,
            'akses' => $request->akses,
            'status' => $request->status,
            'pembuat' => Auth::user()->username
        ];
        
        // return $kegiatan;
        DB::table('kegiatan')->insert($kegiatan);

        return 'Berhasil';
    }
    
    public function edit(Request $request){
        $kegiatan = [
            'nama' => $request->nama,
            'link' => $request->link,
            'shortlink' => $request->shortlink,
            'akses' => $request->akses,
            'status' => $request->status,
        ];
        
        // return $kegiatan;
        DB::table('kegiatan')->where('idk', $request->idk)->update($kegiatan);

        return 'Berhasil';
    }

    public function kunjungikegiatan($idk){
        $tkunjungan = DB::table('kegiatan')->where('idk', $idk)->first()->tkunjungan;
        // $tkunjungan = $tkunjungan + 1;
        DB::table('kegiatan')->where('idk', $idk)->update(['tkunjungan' => $tkunjungan + 1]);
    }

    public function kegiatanpencarian(Request $request){
        $keyword = $request->keyword;
        $status = $request->status;

        $daftarkegiatan = DB::table('kegiatan as k')->select('k.idk', 'k.idp', 'k.nama', 'k.link', 'k.shortlink', 'k.status', 'k.akses', 'p.nama as proyeknama', 'p.akses as proyekakses')
            ->leftjoin('proyek as p', 'k.idp', '=', 'p.idp')
            ->orWhere('k.nama', 'like', '%' . $keyword . '%')
            ->orWhere('k.link', 'like', '%' . $keyword . '%')
            ->orWhere('k.shortlink', 'like', '%' . $keyword . '%')
            ->get();

        if(count($daftarkegiatan) > 0){

            $daftarproyek = [];
            foreach($daftarkegiatan as $kegiatan){
                array_push($daftarproyek, $kegiatan->idp);
            }
            $dproyek = array_unique($daftarproyek);
            
            $dkegiatan = [];
            foreach($dproyek as $dp){
                $kgt = [];
                foreach($daftarkegiatan as $kegiatan){
                    if($kegiatan->proyekakses == "Publik"){
                        if(($kegiatan->idp == $dp) and ($kegiatan->akses == 'Publik') and ($status == 'Semua')){
                            array_push($kgt, $kegiatan);
                        } else if(($kegiatan->idp == $dp) and ($kegiatan->akses == 'Publik') and ($kegiatan->status == $status)){
                            array_push($kgt, $kegiatan);
                        }
                    }
                }
                if(count($kgt) > 0){
                    array_push($dkegiatan, $kgt);
                }
            }
            return $dkegiatan;
        } else {
            return 'tidak ada';
        }   
    }

    public function hapus($idk){
        DB::table('kegiatan')->where('idk', $idk)->delete();
        return 'Berhasil';
    }
}
