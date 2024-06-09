<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        // all methods or actions here will not execute until passed on that middleware
        // $this->middleware('auth')->except('');
        // $this->middleware('auth')->only('');
    }

    // Actions
    public function index()
    {
        // Return response: view, json, redirect, files
        return view('dashboard.index');

        // return View::make('dashboard');

        // return response()->view('dashboard');
        // return Response::view('dashboard');

        // return view('dashboard', ['user' => 'ahmed']);
        // return view('dashboard', compact('user'));
        // return view('dashboard')->with(['user' => 'ahmed']);
    }
}
