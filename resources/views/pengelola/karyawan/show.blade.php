@extends('layouts.app')

@section('style')
    <style>
        .circle {
            width: 250px;
            height: 200px;
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col shadow-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="/pengelola/karyawan" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-3 col-sm-12 text-center pt-3">
                            <img src="@if ($karyawan -> foto)
                                {{ asset('storage/images/karyawan/'.$karyawan->foto) }}
                                @else
                                {{ asset('images/profile/user-1.png') }}
                            @endif" alt="" class="img-thumbnail mb-3 img-fluid circle">

                        </div>
                        <div class="col-lg-9 col-sm-12">

                            <div class="bio">

                                <div class="card mb-3">
                                    <div class="card-header">
                                        Informasi Data Diri
                                    </div>
                                    <div class="card-body pt-3">
                                        <!-- Bordered Tabs -->
                                        <ul class="nav nav-tabs nav-tabs-bordered">
                                            <li class="nav-item">
                                                <button type="button" class="nav-link active" data-bs-toggle="tab"
                                                    data-bs-target="#preview-account">Data
                                                    Personal
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" data-bs-toggle="tab"
                                                    data-bs-target="#preview-personal">Data
                                                    Akses
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content pt-2">
                                            <div class="tab-pane active fade show  profile-edit pt-3" id="preview-account">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">Nama</label>
                                                            <h4>{{ $karyawan -> nama_karyawan }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">NIK</label>
                                                            <h4>{{ $karyawan -> nik }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">Tempat Lahir</label>
                                                            <h4>{{ $karyawan -> tempat_lahir }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">Tanggal Lahir</label>
                                                            <h4>{{ $karyawan -> tanggal_lahir }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">Jenis Kelamin</label>
                                                            <h4>{{ $karyawan -> jenis_kelamin }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">No Telepon</label>
                                                            <h4>{{ $karyawan -> no_telepon }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">Alamat</label>
                                                            <h4>{{ $karyawan -> alamat }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">Divisi</label>
                                                            <h4>{{ $karyawan->divisi->nama_divisi }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show profile-overview" id="preview-personal">
                                                @if ($user)
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">Username</label>
                                                            <h4>{{ $user -> username }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12  mb-3">
                                                        <div class="card" style="border: none">
                                                            <label for="">Email</label>
                                                            <h4>{{ $user -> email }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <h4 class="text-center mt-2">Data Akses Tidak Ada!</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
