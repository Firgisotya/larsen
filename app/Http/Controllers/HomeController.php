<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function HomeAdmin()
    {
        return view('admin.homeAdmin');
    }

    public function HomeKaryawan()
    {
        $checkLocation = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        return view('karyawan.homeKaryawan',
        [
            'lat' => $checkLocation->lat,
            'lon' => $checkLocation->lon,
        ]
    );
    }

    public function tesFoto(Request $request)
    {
        $imageData = $request->input('webcam-pagi');
        $image = substr($imageData, strpos($imageData, ',') + 1);
        $decodedImage = base64_decode($image);

        $imageName = 'tesFoto.png';

        file_put_contents(public_path('images/tesFoto/') . $imageName, $decodedImage);
        return response()->json(['success' => 'Image uploaded successfully']);
    }
}
