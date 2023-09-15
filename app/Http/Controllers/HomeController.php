<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //amount transaction status paid amount fied in table transaction
        $countTransaction = \App\Models\Transaction::count();
        $countTransactionPaid = \App\Models\Transaction::where('status', 'paid')->count();
        $countUser = \App\Models\User::count();
        $countProduct = \App\Models\Product::count();

        //get product by new created_at 6 product
        $products = \App\Models\Product::orderBy('created_at', 'DESC')->take(6)->get();
        $transactions = \App\Models\Transaction::orderBy('created_at', 'DESC')->take(5)->get();
        return view('home', compact('countTransaction', 'countTransactionPaid', 'countUser', 'countProduct', 'products', 'transactions'));
    }
}