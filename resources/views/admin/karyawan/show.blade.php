@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col shadow-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('karyawan.index') }}" class="btn btn-primary">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h1 class="d-inline">Detail Karyawan</h1>
                            </div>
                        </div>
                        <hr>
                        <div class="col-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <h5>NIK </h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>{{ $karyawan->nik }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Nama </h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>{{ $karyawan->nama_karyawan }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Divisi</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $karyawan->divisi->nama_divisi }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Tempat Lahir</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $karyawan->tempat_lahir }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Tanggal Lahir</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $karyawan->tanggal_lahir }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Jenis Kelamin</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $karyawan->jenis_kelamin }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Alamat</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $karyawan->alamat }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>No Telepon</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $karyawan->no_telepon }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Tahun Masuk</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $karyawan->tahun_masuk }}
                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
