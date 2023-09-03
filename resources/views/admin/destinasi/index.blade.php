@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Destinasi</h1>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Kotak Pencarian -->
                    <div class="input-group mb-3">
                        <input id="search" type="text" class="form-control" placeholder="Cari Destinasi"
                            aria-label="Cari Destinasi" aria-describedby="basic-addon2">
                    </div>

                    <a href="{{ route('destinasi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Destinasi
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Destinasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($destinasi as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->nama_destinasi }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            {{-- edit --}}
                                            <a href="{{ route('destinasi.edit', $item->id) }}" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('destinasi.destroy', $item->id) }}" method="POST"
                                                class="d-inline" id="data-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                    data-name="{{ $item->nama_destinasi }}" data-id="{{ $item->id }}"><i
                                                        class='fa fa-trash'></i></button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

                const destinasiId = this.dataset.id;
                const destinasiName = this.dataset.name;
                Swal.fire({
                    title: 'Anda Yakin Menghapus Data Ini ?',
                    text: "Nama Destinasi : " + destinasiName,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const dataId = document.getElementById('data-' + destinasiId);
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
                fetch(`/search-destinasi?query=${query}`)
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
                                    <td>${item.nama_destinasi}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            {{-- edit --}}
                                            <a href="/admin/destinasi/${item.id}/edit" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="admin/destinasi/${item.id}" method="POST"
                                                class="d-inline" id="data-${item.id}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                    data-name="${item.nama_destinasi}" data-id="${item.id}"><i
                                                        class='fa fa-trash'></i></button>
                                            </form>
                                        </div>

                                    </td>
    `;
                tbody.appendChild(row);
            });
        }

    </script>
@endsection
