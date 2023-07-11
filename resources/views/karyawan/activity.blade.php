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
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#kerjakan">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="kerjakan" tabindex="-1"
                                            aria-labelledby="kerjakanLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ $item->nama_tugas }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <p><strong>Deskripsi :</strong>
                                                                    {{ $item->deskripsi_tugas }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <p><strong>Destinasi :</strong>
                                                                    {{ $item->destinasi->nama_destinasi }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <p><strong>Tanggal :</strong> {{ $item->tanggal }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <p><strong>Jam :</strong> {{ $item->jam_mulai }} -
                                                                    {{ $item->jam_selesai }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <form
                                                                    action="{{ route('karyawan.activity.kerjakan', $item->id) }}"
                                                                    method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success">Kerjakan</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($item->status_tugas == 'Dikerjakan')
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#selesaikan">
                                            <i class="fa-regular fa-square-check"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="selesaikan" tabindex="-1"
                                            aria-labelledby="selesaikanLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ $item->nama_tugas }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('karyawan.activity.selesaikan', $item->id) }}">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p><strong>Deskripsi :</strong>
                                                                        {{ $item->deskripsi_tugas }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p><strong>Destinasi :</strong>
                                                                        {{ $item->destinasi->nama_destinasi }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p><strong>Tanggal :</strong> {{ $item->tanggal }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p><strong>Jam :</strong> {{ $item->jam_mulai }} -
                                                                        {{ $item->jam_selesai }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="file-tugas" class="form-label">File
                                                                    Tugas</label>
                                                                <input type="file" class="form-control" id="file-tugas"
                                                                    name="file_tugas" placeholder="File Tugas">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="file-hasil-tugas" class="form-label">File Hasil
                                                                    Tugas</label>
                                                                <input type="file" class="form-control"
                                                                    id="file-hasil-tugas" name="file_hasil_tugas"
                                                                    placeholder="File Hasil Tugas">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="file-laporan" class="form-label">File Laporan
                                                                    Tugas</label>
                                                                <input type="file" class="form-control"
                                                                    id="file-laporan-tugas" name="file_laporan_tugas"
                                                                    placeholder="File Laporan Tugas">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
