<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Proyek extends Controller
{   
    public function getproyek($idp = NULL){
        $daftarproyek = DB::table('proyek')->get();
        if($idp == NULL){
            $dproyek = [];
            foreach($daftarproyek as $dp){
                $banyakkegiatan = DB::table('kegiatan')->where('idp', $dp->idp)->count();
                // return $banyakkegiatan;
                array_push($dproyek, [
                    'proyek' => $dp,
                    'banyakkegiatan' => $banyakkegiatan
                ]);
            }
            return $dproyek;
        }else{
            $proyek = DB::table('proyek')->where('idp', $idp)->get();

            return array($daftarproyek, $proyek);
        }
        // return 'oke';
    }

    public function getproyekfilter($status){
        // return $status;
        $daftarproyek = DB::table('proyek')->where('status', $status)->get();

        $dproyek = [];
        foreach($daftarproyek as $dp){
            $banyakkegiatan = DB::table('kegiatan')->where('idp', $dp->idp)->count();
            // return $banyakkegiatan;
            array_push($dproyek, [
                'proyek' => $dp,
                'banyakkegiatan' => $banyakkegiatan
            ]);
        }
        return $dproyek;
        
    }

    public function getdetailproyek($idp){
        $detailproyek = DB::table('proyek')->where('idp', $idp)->first();
        return $detailproyek;
    }
    
    public function getnamaproyek($idp){
        return DB::table('proyek')->select('nama')->where('idp', $idp)->first();
    }
     
    public function tambahkan(Request $request){
        DB::table('proyek')->insert(['nama' => $request->nama]);
        return 'Berhasil';
    }

     public function edit(Request $request){
        // return $request->akses;
        $proyek = [
            'nama' => $request->nama,
            'status' => $request->status,
            'akses' => $request->akses,
        ];
        
        // return $kegiatan;
        DB::table('proyek')->where('idp', $request->idp)->update($proyek);

        return 'Berhasil';
    }

    public function hapus($idp){
        DB::table('proyek')->where('idp', $idp)->delete();
        DB::table('kegiatan')->where('idp', $idp)->delete();
        return 'Berhasil';
    }
}

