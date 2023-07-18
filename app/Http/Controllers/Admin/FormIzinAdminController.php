<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\FormIzin;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FormIzinAdminController extends Controller
{
    public function index()
    {
        return view('admin.form.index', [
            'form' => FormIzin::with('karyawan')->paginate(10),
        ]);
    }

    public function terima(Request $request, $id)
    {
        $form = FormIzin::findOrFail($id);
        $form->update([
            'status' => 'disetujui'
        ]);

        $cek = FormIzin::findOrFail($id);
        if($cek->status == 'disetujui'){
            Absensi::create([
                'karyawan_id' => $cek->karyawan_id,
                'tanggal' => $cek->tanggal,
                'izin_id' => $cek->id,
            ]);
        }

        Alert::success('Berhasil', 'Form Izin Diterima');
        return redirect()->route('admin.form.index');
    }
}
