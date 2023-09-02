@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Karyawan</h1>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Kotak Pencarian -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="search" placeholder="Cari Karyawan"
                            aria-label="Cari Karyawan" aria-describedby="basic-addon2">
                    </div>

                    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Karyawan
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
                                    <th scope="col">Nama Karyawan</th>
                                    <th scope="col">Divisi</th>
                                    <th scope="col">Tempat Lahir</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Tahun Masuk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $item->nama_karyawan }}</td>
                                        <td>
                                            @if ($item->divisi_id == null)
                                                -
                                            @else
                                                {{ $item->divisi->nama_divisi }}
                                            @endif
                                        </td>
                                        <td>{{ $item->tempat_lahir }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>{{ $item->tahun_masuk }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                {{-- export --}}
                                                <a href="/karyawan/export/{{ $item->id }}" class="btn btn-primary">
                                                    <i class="fas fa-file-export"></i>
                                                </a>

                                                {{-- edit --}}
                                                <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- detail --}}
                                                <a href="{{ route('karyawan.show', $item->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST"
                                                    class="d-inline" id="data-{{ $item->id }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                        data-name="{{ $item->nama_karyawan }}"
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
                            {{ $karyawan->links() }}
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

                const karyawanId = this.dataset.id;
                const karyawanName = this.dataset.name;
                Swal.fire({
                    title: 'Anda Yakin Menghapus Data Ini ?',
                    text: "Nama Karyawan : " + karyawanName,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const dataId = document.getElementById('data-' + karyawanId);
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
                fetch(`/search-karyawan?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update tabel dengan hasil pencarian
                        updateTable(data);
                    });
            }
        });

        function updateTable(data) {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            data.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <th scope="row">${index + 1}</th>
                <td>${item.nama_karyawan}</td>
                <td>${item.divisi ? item.divisi.nama_divisi : '-'}</td>
                <td>${item.tempat_lahir}</td>
                <td>${item.tanggal_lahir}</td>
                <td>${item.alamat}</td>
                <td>${item.no_telepon}</td>
                <td>${item.tahun_masuk}</td>
                <td>
                    <div class="d-flex gap-2">
                                                {{-- export --}}
                                                <a href="/karyawan/export/${item.id}" class="btn btn-primary">
                                                    <i class="fas fa-file-export"></i>
                                                </a>

                                                {{-- edit --}}
                                                <a href="{{ route('karyawan.edit', item.id) }}" class="btn btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- detail --}}
                                                <a href="{{ route('karyawan.show', item.id) }}" class="btn btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('karyawan.destroy', item.id) }}" method="POST"
                                                    class="d-inline" id="data-${item.id}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                        data-name="${item.nama_karyawan}"
                                                        data-id="${item.id}"><i class='fa fa-trash'></i></button>
                                                </form>
                                            </div>
                </td>
            `;
                tbody.appendChild(row);
            });
        }
    </script>
@endsection
