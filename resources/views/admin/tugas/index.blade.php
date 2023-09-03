@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Tugas</h1>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Kotak Pencarian -->
                    <div class="input-group mb-3">
                        <input id="search" type="text" class="form-control" placeholder="Cari Tugas"
                            aria-label="Cari Tugas" aria-describedby="basic-addon2">
                    </div>

                    <a href="{{ route('tugas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Tugas
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Tugas</th>
                                    <th scope="col">Karyawan</th>
                                    <th scope="col">Destinasi</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Mulai</th>
                                    <th scope="col">Jam Selesai</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugas as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $item->nama_tugas }}</td>
                                        <td>{{ $item->karyawan->nama_karyawan }}</td>
                                        <td>{{ $item->destinasi->nama_destinasi }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jam_mulai }}</td>
                                        <td>{{ $item->jam_selesai }}</td>
                                        <td>
                                            @if ($item->file_tugas)
                                            <a href="/download-file/{{ $item->id }}" class="btn btn-info">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                            @else
                                                <span class="badge bg-danger text-white">Tidak Ada File</span>
                                            @endif
                                        </td>
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
                                        <td>
                                            <div class="d-flex gap-2">
                                                {{-- edit --}}
                                                <a href="{{ route('tugas.edit', $item->id) }}" class="btn btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- detail --}}
                                                <a href="{{ route('tugas.show', $item->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('tugas.destroy', $item->id) }}" method="POST"
                                                    class="d-inline" id="data-{{ $item->id }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                        data-name="{{ $item->nama_tugas }}"
                                                        data-id="{{ $item->id }}"><i class='fa fa-trash'></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Tampilkan pagination links -->
                        <div class="d-flex justify-content-center">
                            {{ $tugas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

@section('script')
    <script>
        const deleteButton = document.querySelectorAll('.delete');
        deleteButton.forEach((dBtn) => {
            dBtn.addEventListener('click', function(event) {
                event.preventDefault();

                const tugasId = this.dataset.id;
                const tugasName = this.dataset.name;
                Swal.fire({
                    title: 'Anda Yakin Menghapus Data Ini ?',
                    text: "Nama Tugas : " + tugasName,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const dataId = document.getElementById('data-' + tugasId);
                        dataId.submit();
                    }
                })
            })
        });

        // search
        const searchInput = document.getElementById('search');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.trim();

            if (query !== '') {
                // Kirim permintaan AJAX
                fetch(`/search-tugas?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update tabel dengan hasil pencarian
                        updateTable(data);
                    });
            } else {
                // kirim semua data
                fetch(`/admin/tugas`)
                    .then(response => response.json())
                    .then(data => {
                        updateTable(data)
                    })
            }
        });

        function updateTable(data) {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            data.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `<th scope="row">${index + 1}</th>
        <td>${item.nama_tugas}</td>
        <td>${item.karyawan.nama_karyawan}</td>
        <td>${item.destinasi.nama_destinasi}</td>
        <td>${item.tanggal}</td>
        <td>${item.jam_mulai}</td>
        <td>${item.jam_selesai}</td>
        <td>
            ${item.file_tugas ? `<a href="/download-file/${item.id}" class="btn btn-info">
                <i class="fas fa-file-download"></i>
            </a>` : '<span class="badge bg-danger text-white">Tidak Ada File</span>'}
        </td>
        <td>
            ${item.status_tugas === 'Belum Dikerjakan' ? 
                '<span class="badge bg-dark text-white">Belum Dikerjakan</span>' :
            item.status_tugas === 'Dikerjakan' ? 
                '<span class="badge bg-warning text-white">Dikerjakan</span>' :
            item.status_tugas === 'Selesai' ?
                '<span class="badge bg-success text-white">Selesai</span>' :
            item.status_tugas === 'Ditolak' ?
                '<span class="badge bg-danger text-white">Ditolak</span>' : ''}
        </td>
        <td>
            <div class="d-flex gap-2">
                <a href="admin/tugas/${item.id}/edit" class="btn btn-success">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="admin/tugas/${item.id}" class="btn btn-warning">
                    <i class="fas fa-eye"></i>
                </a>
                <form action="admin/tugas/${item.id}" method="POST" class="d-inline" id="data-${item.id}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger shadow btn-xs sharp me-1 delete" data-name="${item.nama_tugas}" data-id="${item.id}">
                        <i class='fa fa-trash'></i>
                    </button>
                </form>
            </div>
        </td>`;
                tbody.appendChild(row);
            });
        }

    </script>
@endsection
