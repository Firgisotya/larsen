<?php

namespace App\Http\Controllers;

use App\Models\FormIzin;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FormIzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form = FormIzin::all();
        return view('karyawan.form.index', compact('form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormIzin::create([
            'karyawan_id' => auth()->user()->karyawan_id,
            'jenis_izin' => $request->jenis_izin,
            'tanggal_izin' => $request->tanggal_izin,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        Alert::success('Berhasil', 'Form Izin Berhasil Diajukan');
        return redirect()->route('formIzin.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormIzin  $formIzin
     * @return \Illuminate\Http\Response
     */
    public function show(FormIzin $formIzin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormIzin  $formIzin
     * @return \Illuminate\Http\Response
     */
    public function edit(FormIzin $formIzin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormIzin  $formIzin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormIzin $formIzin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormIzin  $formIzin
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormIzin $formIzin)
    {
        //
    }
}
