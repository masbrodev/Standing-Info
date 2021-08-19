<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Gambar;
use App\Vidio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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
        $data['vidio'] = Vidio::first();
        $data['gambar'] = Gambar::get();
        $data['agenda'] = Agenda::orderBy('created_at', 'DESC')->get();

        return view('welcome', $data);
        // return $data;
    }
}
