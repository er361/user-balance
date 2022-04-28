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
        return view('balance-history')->with('title', 'История операции');
    }
}
