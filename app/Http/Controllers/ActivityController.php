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
        dd($id);

        $validateData = $request->validate([
            'file_tugas' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
        ]);

        $file_path = null;

        if($request->hasFile('file_tugas')) {
            $validateData['file_tugas'] = $request->file('file_tugas');
            $filename = $validateData['file_tugas']->getClientOriginalName();
            $file_tugas = $filename;

            // $path = Storage::disk('public')->put('images/tugas/' . $file_tugas, $validateData['file_tugas']);
            $path = $request->file('file_tugas')->storeAs('images/tugas', $file_tugas, 'public');
            $validateData['file_tugas'] = $file_tugas;
            $file_path = $path;
        }

        $tugas = Tugas::where('id', $id)->update([
            'status_tugas' => 'selesai',
            'file_tugas' => $validateData['file_tugas'],
            'file_path' => $file_path,
        ]);

        Alert::success('Berhasil', 'Tugas berhasil diselesaikan');
        return redirect()->back();

    }
}
