<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfileCompany;
use Illuminate\Http\Request;

class MethodHaversineController extends Controller
{
    public function checkHaversine(Request $request)
    {
        $profileCompany = ProfileCompany::first();
        $latitude1 = $profileCompany->latitude;
        $longitude1 = $profileCompany->longitude;

        $latitude2 = $request->latitude;
        $longitude2 = $request->longitude;

        $radius = $profileCompany->radius; // Radius dalam meter

        $distance = $this->haversineDistance($latitude1, $longitude1, $latitude2, $longitude2);

        if ($distance <= $radius) {
            // Koordinat yang diberikan berada dalam radius 100 meter
            // Lakukan sesuatu di sini, misalnya, kembalikan respons berhasil
            return response()->json([
                'code' => 200,
                'message' => 'Berhasil koordinat berada dalam radius ' . $radius . ' meter',
                'data' => $distance
            ], 200);
        } else {
            // Koordinat yang diberikan berada di luar radius 100 meter
            // Lakukan sesuatu di sini, misalnya, kembalikan respons gagal
            return response()->json([
                'code' => 400,
                'message' => 'Gagal koordinat berada di luar radius ' . $radius . ' meter',
                'data' => $distance
            ], 400);
        }
    }

    public function haversineDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        // Konversi latitude dan longitude dari derajat ke radian
        $latitude1Rad = deg2rad($latitude1);
        $longitude1Rad = deg2rad($longitude1);
        $latitude2Rad = deg2rad($latitude2);
        $longitude2Rad = deg2rad($longitude2);

        // Rumus Haversine
        $deltaLatitude = $latitude2Rad - $latitude1Rad;
        $deltaLongitude = $longitude2Rad - $longitude1Rad;
        $a = sin($deltaLatitude / 2) ** 2 + cos($latitude1Rad) * cos($latitude2Rad) * sin($deltaLongitude / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Radius Bumi dalam meter
        $earthRadius = 6371000;

        // Hitung jarak
        $distance = $earthRadius * $c;

        return $distance;
    }
}