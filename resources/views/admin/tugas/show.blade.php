@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col shadow-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('tugas.index') }}" class="btn btn-primary">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h1 class="d-inline">Detail Tugas</h1>
                            </div>
                        </div>
                        <hr>
                        <div class="col-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <h5>Nama Karyawan </h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>{{ $tugas->karyawan->nama_karyawan }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Nama </h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>{{ $tugas->destinasi->nama_destinasi }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Nama Tugas</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->nama_tugas }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Deskripsi Tugas</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->deskripsi_tugas }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Tanggal</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->tanggal }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Jam Mulai</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->jam_mulai }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Jam Selesai</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->jam_selesai }}
                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

