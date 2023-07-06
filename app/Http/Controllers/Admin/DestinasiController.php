<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinasi = Destinasi::all();
        return view('admin.destinasi.index', compact('destinasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.destinasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_destinasi' => 'required',
        ]);

        Destinasi::create($validateData);
        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.destinasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function show(Destinasi $destinasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Destinasi $destinasi)
    {
        return view('admin.destinasi.edit', compact('destinasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destinasi $destinasi)
    {
        $validateData = $request->validate([
            'nama_destinasi' => 'required',
        ]);

        $destinasi->update($validateData);
        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.destinasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destinasi $destinasi)
    {
        $destinasi->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.destinasi.index');
    }
}
