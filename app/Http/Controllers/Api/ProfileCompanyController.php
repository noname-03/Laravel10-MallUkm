<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfileCompany;
use Illuminate\Http\Request;

class ProfileCompanyController extends Controller
{
    public function index()
    {
        $profileCompany = ProfileCompany::first();
        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Profil Perusahaan',
            'data' => $profileCompany
        ], 200);
    }
}
