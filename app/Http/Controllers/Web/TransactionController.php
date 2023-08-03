<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest('created_at')->get();
        return view('pages.transaction.index', compact('transactions'));
    }

    // edit
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('pages.transaction.edit', compact('transaction'));
    }

    //update
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'status' => $request->status,
            'receipt_number' => $request->receipt_number,
        ]);
        return redirect()->route('transaction.index');
    }

    //show
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('pages.transaction.show', compact('transaction'));
    }

}