<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::with(['user', 'divisi'])->paginate(10);
        return view('admin.karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.karyawan.create', [
            'divisi' => Divisi::all(),
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

        $validatedData = $request->validate([
        'divisi_id' => 'required',
        'nik' => 'required|unique:karyawans',
        'nama_karyawan' => 'required',
        'tanggal_lahir' => 'required',
        'tempat_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
        'no_telepon' => 'required',
        'tahun_masuk' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|unique:users',
        'password' => 'required',
        'role' => 'required'
        ]);

        $karyawan = Karyawan::create([
            'divisi_id' => $validatedData['divisi_id'],
            'nik' => $validatedData['nik'],
            'nama_karyawan' => $validatedData['nama_karyawan'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'alamat' => $validatedData['alamat'],
            'no_telepon' => $validatedData['no_telepon'],
            'tahun_masuk' => $validatedData['tahun_masuk'],
        ]);

        User::create([
            'karyawan_id' => $karyawan->id,
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('karyawan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        $karyawan = Karyawan::with(['user', 'divisi'])->findOrFail($karyawan->id);
        return view('pages.admin.karyawan.detail', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        return view('pages.admin.karyawan.edit', [
            'karyawan' => $karyawan,
            'divisi' => Divisi::all(),
            'user' => User::where('karyawan_id', $karyawan->id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $validatedData = $request->validate([
            'divisi_id' => 'required',
            'nik' => 'required|unique:karyawans',
            'nama_karyawan' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'tahun_masuk' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required'
            ]);

            $karyawan->update([
                'divisi_id' => $validatedData['divisi_id'],
                'nik' => $validatedData['nik'],
                'nama_karyawan' => $validatedData['nama_karyawan'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'alamat' => $validatedData['alamat'],
                'no_telepon' => $validatedData['no_telepon'],
                'tahun_masuk' => $validatedData['tahun_masuk'],
            ]);

            User::where('karyawan_id', $karyawan->id)->update([
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role' => $validatedData['role'],
            ]);

            Alert::success('Berhasil', 'Data Berhasil Diubah');
            return redirect()->route('karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan = Karyawan::findOrFail($karyawan->id);
        try {
            $karyawan->delete();
            Alert::success('Berhasil', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                Alert::error('Gagal', 'Data Gagal Dihapus');
            }
        }
        return redirect()->route('karyawan.index');
    }
}
