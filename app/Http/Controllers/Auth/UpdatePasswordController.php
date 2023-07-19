<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UpdatePasswordController extends Controller
{
    public function getUser()
    {
        return view('karyawan.password.update');
    }

    public function getAdmin()
    {
        return view('admin.password.update');
    }

    public function update(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|min:3|string|same:newPasswordConfirmation',
        ]);

        if(!Hash::check($request->oldPassword, auth()->user()->password)){
            Alert::error('Error', 'Password lama tidak sesuai');
            return redirect()->back();
        }

        if (strcmp($request->get('oldPassword'), $request->newPassword) == 0)
        {
            Alert::error('Error', 'Password tidak boleh sama dengan password lama');
            return redirect()->back();
        }

        User::whereId(auth()->user()->id)->update([
            'password' => bcrypt($request->newPassword),
            'secret' => $request->newPassword
        ]);
        Alert::success('Berhasil', 'Password Berhasil Diubah');
        return redirect()->back();
    }
}
