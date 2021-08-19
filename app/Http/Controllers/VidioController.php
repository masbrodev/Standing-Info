<?php

namespace App\Http\Controllers;

use App\Vidio;
use Illuminate\Http\Request;

class VidioController extends Controller
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
        $data['vidio'] = Vidio::where('id', 1)->first();
        return view('pages.vidio', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vidio  $vidio
     * @return \Illuminate\Http\Response
     */
    public function show(Vidio $vidio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vidio  $vidio
     * @return \Illuminate\Http\Response
     */
    public function edit(Vidio $vidio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vidio  $vidio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vidio)
    {
        $data = [
            'link' => $request->link,
        ];
        $save = Vidio::where('id', $vidio)->update($data);
        if ($save) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vidio  $vidio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vidio $vidio)
    {
        //
    }
}
