<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        Alert::success('Berhasil', 'Form Izin Diterima');
        return redirect()->route('admin.form.index');
    }
}
