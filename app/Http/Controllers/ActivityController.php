<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $tugas = Tugas::find($request->id);
        $tugas->status_tugas = 'dikerjakan';
        $tugas->save();

        Alert::success('Berhasil', 'Tugas berhasil dikerjakan');
        return redirect()->back();
    }

    public function selesaikan(Request $request, $id)
    {
        $validateDate = $request->validate([
            'file_tugas' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'file_hasil_tugas' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'file_laporan_tugas' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        if($validateDate){
            $tugas = Tugas::find($request->id);
            $tugas->status_tugas = 'selesai';
            $tugas->file_tugas = $request->file('file_tugas')->store('file_tugas');
            $tugas->file_hasil_tugas = $request->file('file_hasil_tugas')->store('file_hasil_tugas');
            $tugas->file_laporan_tugas = $request->file('file_laporan_tugas')->store('file_laporan_tugas');
            $tugas->save();
        }
        
        
        Alert::success('Berhasil', 'Tugas berhasil diselesaikan');
        return redirect()->back();
    }
}
