<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Gambar;
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
        return view('home');
    }

    public function welcome()
    {
        $data['gambar'] = Gambar::get();
        $data['agenda'] = Agenda::get();

        return view('welcome', $data);
        return $data;
    }
}
