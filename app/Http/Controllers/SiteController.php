<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    //
    public function index()
    {
        return view('main')
            ->with('title', 'Главная');
    }

    public function signIn()
    {
        return view('sign-in')->with('title', 'Login');
    }

    public function balanceHistory()
    {
        return view('main')->with('title', 'История операции');
    }
}
