<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiKantor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LokasiKantorController extends Controller
{
    public function index()
    {
        $kantor = LokasiKantor::all();
        return view('admin.kantor.index',
        [
            'kantor' => $kantor,]
    );
    }

    public function create()
    {
        return view('admin.kantor.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_kantor' => 'required',
            'alamat_kantor' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required'
        ]);

        $kantor = LokasiKantor::create($validateData);

        Alert::success('Berhasil', 'Data berhasil ditambahkan');
        return redirect()->route('lokasiKantor.index');
    }

    public function show($id)
    {
        return view('admin.kantor.show');
    }

    public function edit($id)
    {
        $kantor = LokasiKantor::find($id);
        return view('admin.kantor.edit', [
            'kantor' => $kantor,

        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama_kantor' => 'required',
            'alamat_kantor' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required'
        ]);

        $kantor = LokasiKantor::find($id);
        $kantor->update($validateData);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('lokasiKantor.index');
    }

    public function destroy($id)
    {
        $kantor = LokasiKantor::find($id);
        $kantor->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('lokasiKantor.index');
    }
}
