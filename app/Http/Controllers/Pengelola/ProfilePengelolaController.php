<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilePengelolaController extends Controller
{
    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->with('karyawan')->first();
        return view('admin.profile', [
            'user' => $user,
            'divisi' => Divisi::all(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $karyawan = Karyawan::find($user->karyawan->id);

        $validatedData = $request->validate([
            'divisi_id' => 'required',
            'nik' => 'required',
            'nama_karyawan' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,

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

        Karyawan::where('id', $karyawan->id)->update([
            'divisi_id' => $validatedData['divisi_id'],
            'nik' => $validatedData['nik'],
            'nama_karyawan' => $validatedData['nama_karyawan'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'alamat' => $validatedData['alamat'],
            'no_telepon' => $validatedData['no_telepon'],
            'foto' => $validatedData['foto'],
        ]);

        User::where('id', Auth::user()->id)->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
        ]);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('admin.profile');


    }
}
