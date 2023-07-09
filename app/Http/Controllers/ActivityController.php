<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $activity = Tugas::where('karyawan_id', Auth::user()->karyawan_id)->paginate(10);
        return view('karyawan.activity', compact('activity'));
    }
}
