<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // If the user is not an admin, redirect to the login page with an error message.
        Auth::logout(); // Logout user if not an admin
        return redirect()->route('login')->with('error', 'Anda Harus Login Sebagai Admin Untuk Mengakses Halaman Ini.!!!');
    }
}