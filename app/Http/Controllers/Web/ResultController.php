<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::with('answers')->get();

        $results->map(function ($result) {
            // $averageMis = round($result->answers->avg('mis'), 2);
            // $averageMss = round($result->answers->avg('mss'), 2);
            $averageMis = $result->answers->avg('mis');
            $averageMss = $result->answers->avg('mss');
            $result->averageMis = $averageMis;
            $result->averageMss = $averageMss;
            return $result;
        });

        $totalMis = 0;

        foreach ($results as $item) {
            $totalMis += $item->averageMis;
        }

        $results->map(function ($result) use ($totalMis) {
            // $result->wf = round(($result->averageMis / $totalMis) * 100, 2);
            $result->total = $totalMis;
            $result->wf = $result->averageMis / $totalMis * 100;
            $result->ws = $result->wf * $result->averageMss;
            return $result;
        });


        $totalWt = 0;

        foreach ($results as $item) {
            $totalWt += $item->ws;
        }

        $csi = round(($totalWt / 5), 2);
        return view('pages.result.index', compact('results', 'totalMis', 'totalWt', 'csi'));
    }

    public function destroy($id)
    {
        $result = Result::findOrFail($id);
        $result->delete();

        return redirect()->route('result.index');
    }
}