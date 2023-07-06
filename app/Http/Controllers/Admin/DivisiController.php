<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Divisi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisi = Divisi::all();
        return view('admin.divisi.index', compact('divisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view ('admin.divisi.create');
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
            'nama_divisi' => 'required',
        ]);

        Divisi::create($validateData);
        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('divisi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Divisi $divisi)
    {
        return view('admin.divisi.edit', compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Divisi $divisi)
    {
        $validateData = $request->validate([
            'nama_divisi' => 'required',
        ]);

        $divisi->update($validateData);
        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('divisi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Divisi $divisi)
    {
        $divisi = Divisi::findOrFail($divisi->id);
        try {
            $divisi->delete();
            alert()->success('SuccessAlert','Data Berhasil dihapus.');
        } catch (\Throwable $th) {
            if($th->getCode() == 23000){
                alert()->error('ErrorAlert','Data Gagal dihapus.');
            }
        }
        return redirect()->route('divisi.index');
    }
}
