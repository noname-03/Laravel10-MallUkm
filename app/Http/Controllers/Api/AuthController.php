<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use JWTAuth;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'code' => 200,
            'message' => 'Registrasi Berhasil!',
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'code' => '404',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'code' => '200',
            'message' => 'Login Berhasil!',
            'data' => $jwt_token,
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->guard('api')->logout();
        return response()->json([
            'code' => '200',
            'message' => 'Logout Berhasil!',
        ], 200);

    }

    public function getUser(Request $request)
    {
        $user = auth()->user();

        return response()->json(['user' => $user]);
    }

    public function me()
    {
        $user = auth()->guard('api')->user();

        return response()->json([
            'code' => '200',
            'message' => 'Berhasil Mengambil Data!',
            'data' => $user
        ], 200);
    }
}