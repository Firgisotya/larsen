@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Activity</h1>
                <div class="table-responsive">
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
                                                data-bs-target="#kerjakan_{{ $item->id }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="kerjakan_{{ $item->id }}" tabindex="-1"
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
                                                                    <p><strong>Nama Tugas :</strong>
                                                                        {{ $item->nama_tugas }}</p>
                                                                </div>
                                                            </div>
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
                                                data-bs-target="#selesaikan_{{ $item->id }}">
                                                <i class="fa-regular fa-square-check"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="selesaikan_{{ $item->id }}" tabindex="-1"
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
                                                                action="{{ route('karyawan.activity.selesaikan', $item->id) }}"
                                                                enctype="multipart/form-data">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <p><strong>Nama Tugas :</strong>
                                                                            {{ $item->nama_tugas }}</p>
                                                                    </div>
                                                                </div>
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
                                                                        <p><strong>Tanggal :</strong> {{ $item->tanggal }}
                                                                        </p>
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
                                                                        Tugas (Maksimal 5MB)</label>
                                                                    <input type="file" class="form-control"
                                                                        id="file-tugas" name="file_tugas"
                                                                        placeholder="File Tugas"
                                                                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                                                        onchange="validateFile(this)">
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
                    {{ $activity->links() }}
                </div>

            </div>
        </div>
        @include('sweetalert::alert')
    @endsection

    @section('script')
        <!-- Make sure you include SweetAlert library in your HTML -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            function validateFile(input) {
                const file = input.files[0];
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
                const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

                if (file) {
                    const fileName = file.name;
                    const fileSize = file.size;
                    const fileExtension = fileName.split('.').pop().toLowerCase();

                    if (!allowedExtensions.includes(fileExtension)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format File Tidak Didukung!',
                            text: 'Harap upload file dengan format jpg, jpeg, png, pdf, doc, docx, xls, atau xlsx .',
                        });
                        input.value = '';
                    } else if (fileSize > maxFileSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran File Terlalu Besar!',
                            text: 'Harap Upload File dibawah 5MB.',
                        });
                        input.value = '';
                    }
                }
            }
        </script>
    @endsection
