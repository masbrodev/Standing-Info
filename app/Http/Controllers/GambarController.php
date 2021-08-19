<?php

namespace App\Http\Controllers;

use App\Gambar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['gambar'] = Gambar::get();
        return view('pages.gambar', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $berkas = $request->file('gambar');

        $name = uniqid() . '_IMG_' . trim($berkas->getClientOriginalName());
        $berkas->move('berkas/gambar/', $name);

        Gambar::create([
            'nama' => $request->nama,
            'lokasi' => 'berkas/gambar/' . $name,
            'kondisi' => 'T'
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gambar  $gambar
     * @return \Illuminate\Http\Response
     */
    public function show(Gambar $gambar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gambar  $gambar
     * @return \Illuminate\Http\Response
     */
    public function edit($gambar)
    {
        $data = Gambar::where('id', $gambar)->first();
        $path = public_path($data->lokasi);

        if (file_exists($path)) {
            $data->delete();
            unlink($path);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gambar  $gambar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gambar $gambar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gambar  $gambar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gambar $gambar)
    {
        //
    }
}
