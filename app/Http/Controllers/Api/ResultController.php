<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->guard('api')->user();
        $result = $user->results()->create([
            'suggestion' => $request->suggestion,
        ]);

        //looping request answers in array $request->answers
        foreach ($request->answers as $answer) {
            $result->answers()->create([
                'number' => $answer['number'],
                'title' => $answer['title'],
                'mis' => $answer['mis'],
                'mss' => $answer['mss'],
            ]);
        }

        return response()->json([
            'success' => 200,
            'message' => 'Berhasil Menyimpan Data Hasil',
            'data' => $request->all()
        ], 200);
    }
}