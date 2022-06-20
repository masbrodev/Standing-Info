<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Vidio;
use App\Gambar;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data['agenda'] = Agenda::orderBy('id', 'DESC')->get();
        return view('pages.agenda', $data);
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
        $data = [
            'nama' => $request->nama,
            'tempat' => $request->tempat == 'oth' ? $request->tempat2 : $request->tempat,
            'waktu' => $request->tgl . ' ' . $request->jam,
            'dari'=> $request->dari,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'sampai' => $request->tgl . ' ' . $request->sampai
                ];
        $save = Agenda::create($data);
        if ($save) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit($agenda)
    {
        $delete = Agenda::where('id', $agenda)->delete();
        if ($delete) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $agenda)
    {
        $data = [
            'nama' => $request->nama,
            'tempat' => $request->tempat == 'oth' ? $request->tempat2 : $request->tempat,
            'waktu' => $request->tgl . ' ' . $request->jam,
            'dari'=> $request->dari,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'sampai' => $request->tgl . ' ' . $request->sampai
        ];
        $save = Agenda::where('id', $agenda)->update($data);
        if ($save) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        //
    }

    public function adminjadwal(){
        $data['agenda'] = Agenda::get();
        return view('pages.adminjadwal', $data);
    }

    public function jadwal()
    {
        // $data['agenda'] = Agenda::whereDate('waktu', Carbon::now())
        //                         ->orWhereDate('waktu', Carbon::tomorrow())
        //                         ->get();
        // $data['agenda'] = Agenda::where('waktu', '>=', Carbon::now())->get();
        $data['agenda'] = Agenda::get();

        // return $data['agenda'];
        return view('jadwal', $data);
    }
}
