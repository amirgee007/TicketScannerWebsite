<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PagesController extends Controller
{

    public function base()
    {
        return view('pages/index');
    }
    public function login()
    {
        return view('pages/login');
    }
    public function register()
    {
        return view('pages/register');
    }
    public function about()
    {
        return view('pages/about');
    }


}
