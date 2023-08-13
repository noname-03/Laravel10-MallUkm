<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        // Ambil nilai bulan dan tahun dari query parameter
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        // dd($bulan, $tahun);
        // Jika bulan dan tahun tidak ada, tampilkan semua data
        if (empty($bulan) || empty($tahun)) {
            $results = Result::with('answers')->get();
        } else {
            // Jika bulan dan tahun ada, filter data berdasarkan bulan dan tahun
            $results = Result::whereMonth('created_at', '=', $bulan)
                ->whereYear('created_at', '=', $tahun)
                ->with('answers')
                ->get();
        }

        $results->map(function ($result) {
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

        // Menghitung rata-rata MIS dan MSS per pertanyaan
        $totalPertanyaan = 16; // Jumlah pertanyaan (kolom)
        $rataRatamis = array_fill(0, $totalPertanyaan, 0);
        $rataRatamss = array_fill(0, $totalPertanyaan, 0);

        foreach ($results as $result) {
            foreach ($result['answers'] as $key => $answer) {
                $rataRatamis[$key] += $answer['mis'];
                $rataRatamss[$key] += $answer['mss'];
            }
        }

        $totalResults = count($results);

        if ($totalResults > 0) {
            foreach ($rataRatamis as &$value) {
                $value /= $totalResults; // Menghitung rata-rata
                $value = round($value, 2); // Pembulatan ke 2 angka desimal
            }

            foreach ($rataRatamss as &$value) {
                $value /= $totalResults; // Menghitung rata-rata
                $value = round($value, 2); // Pembulatan ke 2 angka desimal
            }
        }

        $pembulatan = floor($csi);

        if ($pembulatan >= 0 && $pembulatan <= 19) {
            $csis = "Tidak Puas";
        } elseif ($pembulatan >= 20 && $pembulatan <= 39) {
            $csis = "Kurang Puas";
        } elseif ($pembulatan >= 40 && $pembulatan <= 59) {
            $csis = "Puas";
        } elseif ($pembulatan >= 60 && $pembulatan <= 79) {
            $csis = "Cukup Puas";
        } elseif ($pembulatan >= 80 && $pembulatan <= 100) {
            $csis = "Sangat Puas";
        } else {
            $csis = "Nilai tidak valid";
        }

        return view('pages.result.index', compact('results', 'totalMis', 'totalWt', 'csi', 'rataRatamis', 'rataRatamss', 'csis'));
    }

    // show
    public function show($id)
    {
        $result = Result::findOrFail($id);
        $result->load('answers');
        // return response()->json($result);
        return view('pages.result.show', compact('result'));
    }

    public function destroy($id)
    {
        $result = Result::findOrFail($id);
        $result->delete();

        return redirect()->route('result.index');
    }
}