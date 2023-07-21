<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function index(){
        return view('auth.passwords.reset', [
            'title' => 'Lupa Paswword'
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $validateData = $request->validate(['email' => 'required|email']);
        $userCheck = User::where('email', $validateData['email'])->first();

        if($userCheck != null){
            User::where('email', $validateData['email'])->update([
                'password' => bcrypt($user->username),
                'secret' => $user->username
            ]);
            Alert::success('Berhasil', 'Password berhasil direset');
            return redirect()->route('login');
        }
        else{
            Alert::error('Gagal', 'Email tidak terdaftar');
            return redirect()->back();
        }


        
    }
}
