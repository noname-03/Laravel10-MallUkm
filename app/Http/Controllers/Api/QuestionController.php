<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::where('status', 1)->get();
        return response()->json([
            'success' => 200,
            'message' => 'Berhasil Mengambil Data Pertanyaan',
            'data' => $questions
        ], 200);
    }
}