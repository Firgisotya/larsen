<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;

use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\RoleManajemen;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Svg\Gradient\Stop;
use PDF;

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
        return view('pengelola.karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengelola.karyawan.create', [
            'divisi' => Divisi::all(),
            'role' => RoleManajemen::all(),
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
            'role' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('images/karyawan/' . $filename, file_get_contents($file));
            $validatedData['foto'] = $filename;
        }

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
            'foto' => $validatedData['foto'],
        ]);

        User::create([
            'karyawan_id' => $karyawan->id,
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role_id' => $validatedData['role'],
            'secret' => $validatedData['password'],
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
    public function show($id)
    {
        $karyawan = Karyawan::with(['user', 'divisi'])->findOrFail($id);
        $user = User::where('karyawan_id', $karyawan->id)->first();
        return view('pengelola.karyawan.show', [
            'karyawan' => $karyawan,
            'user' => $user,
            'role' => RoleManajemen::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        return view('pengelola.karyawan.edit', [
            'karyawan' => $karyawan,
            'divisi' => Divisi::all(),
            'user' => User::where('karyawan_id', $karyawan->id)->first(),
            'role' => RoleManajemen::all(),
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
            'nik' => 'required',
            'nama_karyawan' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'tahun_masuk' => 'required',
            'role' => 'required',
            'foto' => 'required|max:2048',

        ]);

        if ($request->hasFile('foto')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete('images/karyawan/' . $request->oldImage);
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            Storage::disk('public')->put('images/karyawan/' . $filename, file_get_contents($file));
            // $validtaedData['foto'] = $request->file('foto')->store('/images/karyawan', 'public');
            $validatedData['foto'] = $filename;
        }


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
            'foto' => $validatedData['foto'],
        ]);

        User::where('karyawan_id', $karyawan->id)->update([
            'role_id' => $validatedData['role'],
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

        if (User::where('karyawan_id', $karyawan->id)->exists()) {
            Alert::error('Gagal', 'Data Tidak Bisa Dihapus Karena Memiliki Relasi');
            return redirect()->route('karyawan.index');
        }

        $karyawan->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('karyawan.index');
    }

    // export pdf
    public function exportKaryawan($id)
{
    $user = User::where('karyawan_id', $id)->with('karyawan')->first();

    $pdf = PDF::loadView('pengelola.karyawan.export-karyawan', compact('user'));
    $filename = $user->karyawan->nama_karyawan . '.pdf';

    return $pdf->download($filename);
}

}
