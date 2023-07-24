<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Karyawan;
use App\Models\Tugas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tugas = Tugas::with('karyawan', 'destinasi')->paginate(10);
        return view('admin.tugas.index', compact('tugas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tugas.create', [
            'destinasi' => Destinasi::get(),
            'karyawan' => Karyawan::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
            'nama_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'karyawan_id' => 'required',
            'destinasi_id' => 'required',
            ]
        );

        Tugas::create($validateData);
        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('tugas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tugas = Tugas::with('karyawan', 'destinasi')->findOrFail($id);

        return view('admin.tugas.show', [
            'tugas' => $tugas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.tugas.edit', [
            'tugas' => Tugas::findOrFail($id),
            'destinasi' => Destinasi::get(),
            'karyawan' => Karyawan::get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate(
            [
            'nama_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'karyawan_id' => 'required',
            'destinasi_id' => 'required',
            'status_tugas' => 'required',
            ]
        );

        Tugas::where('id', $id)->update($validateData);
        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('tugas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugas $tugas, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $tugas->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('tugas.index');
    }
}
