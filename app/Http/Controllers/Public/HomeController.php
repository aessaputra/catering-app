<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.home');
    }

    public function menu()
    {
        return view('public.menu');
    }

    public function cart()
    {
        return view('public.cart');
    }
}

