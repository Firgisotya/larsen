<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordMail;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        return view('auth.passwords.email', [
            'title' => 'Lupa Paswword'
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validateData = $request->validate(['email' => 'required|email']);
        $user = User::where('email', $validateData['email'])->first();
    
        if ($user !== null) {
            $encryptedUserId = Crypt::encrypt($user->id);
            $data = [
                'nama_karyawan' => $user->karyawan->nama_karyawan,
                'username' => $user->username,
                'link' => 'http://localhost:3000/reset-password?token=' . urlencode($encryptedUserId),
            ];
            Mail::to($validateData['email'])->send(new PasswordMail($data));
            Alert::success('Berhasil', 'Silahkan Cek Email Anda');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Email Tidak Terdaftar');
            return redirect('/');
        }
    }

    public function resetPassword(Request $request)
    {
        $encryptedUserId = $request->query('token');
        try {
            $userId = Crypt::decrypt(urldecode($encryptedUserId));
            $user = User::findOrFail($userId);
            // You can now use $user to display user information on the password reset form if needed.
            return view('auth.passwords.reset', ['encryptedUserId' => $encryptedUserId]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error (e.g., invalid token).
            // Redirect to an error page or show an error message to the user.
            return redirect('/')->withErrors(['token' => 'Invalid reset token']);
        }
    }

    public function submitReset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8',
            'newPasswordConfirmation' => 'required|same:password'
        ]);

        try {
            $userId = Crypt::decrypt(urldecode($request->input('token')));
            $user = User::findOrFail($userId);
            $user->update([
                'password' => Hash::make($request->input('password')),
                'secret' => $request->input('password'),
            ]);
            // You can also add additional logic, such as logging the user in automatically after the password reset.

            Alert::success('Berhasil', 'Password Berhasil Diubah');
            return redirect('/');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error (e.g., invalid token).
            // Redirect to an error page or show an error message to the user.
            Alert::error('Gagal', 'Password Gagal Diubah');
            return redirect('/');
        }

        
        
    }
}
