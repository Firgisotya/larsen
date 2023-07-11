<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ActivityController extends Controller
{
    public function index()
    {
        $activity = Tugas::where('karyawan_id', Auth::user()->karyawan_id)->where('status_tugas', '!=', 'selesai')->paginate(10);
        return view('karyawan.activity', compact('activity'));
    }

    public function kerjakan(Request $request, $id)
    {
        $tugas = Tugas::find($id);
        $tugas->status_tugas = 'dikerjakan';
        $tugas->save();

        Alert::success('Berhasil', 'Tugas berhasil dikerjakan');
        return redirect()->back();
    }

    public function selesaikan(Request $request, $id)
    {
        // dd($request->all());

        $validateData = $request->validate([
            'file_tugas' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'file_hasil_tugas' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'file_laporan_tugas' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);



        if($request->hasFile('file_tugas')) {
            $validateData['file_tugas'] = $request->file('file_tugas');
            $filename = 'tugas_' . $id . '_' . time() . '.' . $validateData['file_tugas']->getClientOriginalExtension();
            $file_tugas = $filename;

            Storage::disk('public')->put('images/tugas/' . $file_tugas, $validateData['file_tugas']);

        }
        if($request->hasFile('file_hasil_tugas')) {
            $validateData['file_hasil_tugas'] = $request->file('file_hasil_tugas');
            $filename = 'hasil_tugas_' . $id . '_' . time() . '.' . $validateData['file_hasil_tugas']->getClientOriginalExtension();
            $file_hasil_tugas = $filename;

            Storage::disk('public')->put('images/hasil_tugas/' . $file_hasil_tugas, $validateData['file_hasil_tugas']);

        }
        if($request->hasFile('file_laporan_tugas')) {
            $validateData['file_laporan_tugas'] = $request->file('file_laporan_tugas');
            $filename = 'laporan_tugas_' . $id . '_' . time() . '.' . $validateData['file_laporan_tugas']->getClientOriginalExtension();
            $file_laporan_tugas = $filename;

            Storage::disk('public')->put('images/laporan_tugas/' . $file_laporan_tugas, $validateData['file_laporan_tugas']);
        }

        $tugas = Tugas::where('id', $id)->update([
            'status_tugas' => 'selesai',
            'file_tugas' => $file_tugas,
            'file_hasil_tugas' => $file_hasil_tugas,
            'file_laporan_tugas' => $file_laporan_tugas,
        ]);

        Alert::success('Berhasil', 'Tugas berhasil diselesaikan');
        return redirect()->back();

    }
}
