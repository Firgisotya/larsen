@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Activity</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tugas</th>
                            <th>Destinasi</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activity as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->nama_tugas }}</td>
                                <td>{{ $item->destinasi->nama_destinasi }}</td>
                                <td>{{ $item->deskripsi_tugas }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->jam_mulai }}</td>
                                <td>{{ $item->jam_selesai }}</td>
                                <td>
                                    @if ($item->status_tugas == 'Belum Dikerjakan')
                                        <span class="badge bg-dark text-white">{{ $item->status_tugas }}</span>
                                    @elseif ($item->status_tugas == 'Dikerjakan')
                                        <span class="badge bg-warning text-white">{{ $item->status_tugas }}</span>
                                    @elseif ($item->status_tugas == 'Selesai')
                                        <span class="badge bg-success text-white">{{ $item->status_tugas }}</span>
                                    @elseif ($item->status_tugas == 'Ditolak')
                                        <span class="badge bg-danger text-white">{{ $item->status_tugas }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_tugas == 'Belum Dikerjakan')
                                        <a href="" class="btn btn-warning btn-sm">Kerjakan</a>
                                        
                                    @elseif ($item->status_tugas == 'Dikerjakan')
                                        <a href="" class="btn btn-success btn-sm">Selesai</a>
                                        
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
