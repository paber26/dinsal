<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Controller
{
    public function getuser($id = NULL){
        if($id == NULL){
            return DB::table('users')->get();
        }else{
            return DB::table('users')->where('id', $id)->first();
        }
    }

    public function tambahkan(Request $request){
        // return $nama;
        $nama = $request->nama;
        $username = $request->username;
        $password = $request->password;

        // return $username;

        $user = DB::table('users')->where(['username' => $username])->first();

        if ($user != null) {
            return 'Sudah terdaftar';
        } else {
            $stt = [
                'nama' => $nama,
                'username' => $username,
                'password' => Hash::make($password),
                'api_token' => Str::random(40),
            ];
            // return $stt;
            DB::table('users')->insert($stt);

            return 'Berhasil';
        }
    }

    public function edit(Request $request){
        $user = [
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];
        
        // return $request->id;
        DB::table('users')->where('id', $request->id)->update($user);

        return 'Berhasil';
    }


    public function hapus($username){
        DB::table('users')->where('username', $username)->delete();
        return 'Berhasil';
    }
}
