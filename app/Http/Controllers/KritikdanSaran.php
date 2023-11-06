<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KritikdanSaran extends Controller
{
    public function getkritikdansaran(){
        return DB::table('kritikdansaran')->get();
    }

    public function kirim(Request $request){
        // return $request;
        $kritikdansaran = [
            'isi' => $request->isi,
            'bintang' => $request->bintang
        ];
        // return $kritikdansaran;
        DB::table('kritikdansaran')->insert($kritikdansaran);
        return 'Berhasil';
    }

    public function tes(){
        return 'oke';
    }
}
