<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        //cek $request password lama kalau sesuai bisa ganti password
        if (!\Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'code' => 400,
                'message' => 'Password Lama Tidak Sesuai',
            ]);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengubah Password',
        ]);
    }
}