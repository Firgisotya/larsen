@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Form Izin</h1>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Kotak Pencarian -->
                    <div class="input-group mb-3">
                        <input id="search" type="text" class="form-control" placeholder="Cari izin"
                            aria-label="Cari izin" aria-describedby="basic-addon2">
                    </div>

                    <a href="{{ route('formIzin.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajukan Izin
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
                                <th scope="col">Jenis Izin</th>
                                <th scope="col">Tanggal Izin</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($form as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->jenis_izin }}</td>
                                    <td>{{ $item->tanggal_izin }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <span class="badge bg-warning text-white">{{ $item->status }}</span>
                                        @elseif ($item->status == 'disetujui')
                                            <span class="badge bg-success text-white">{{ $item->status }}</span>
                                        @elseif ($item->status == 'ditolak')
                                            <span class="badge bg-danger text-white">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            {{-- Delete --}}
                                            <form action="{{ route('formIzin.destroy', $item->id) }}" method="POST"
                                                class="d-inline" id="data-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                    data-name="{{ $item->jenis_izin }}"
                                                    data-id="{{ $item->id }}"><i class='fa fa-trash'></i></button>
                                            </form>
                                        @endif

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

                const izinId = this.dataset.id;
                const izinName = this.dataset.name;
                Swal.fire({
                    title: 'Anda Yakin Menghapus Data Ini ?',
                    text: "Nama Jenis Izin : " + izinName,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const dataId = document.getElementById('data-' + izinId);
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
                fetch(`/search-izinKaryawan?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update tabel dengan hasil pencarian
                        updateTable(data);
                    });
            } else {
                // kirim semua data
                fetch(`/karyawan/formIzin`)
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
                row.innerHTML = `
                <th scope="row">${index + 1}</th>
                                    <td>${item.jenis_izin}</td>
                                    <td>${item.tanggal_izin}</td>
                                    <td>${item.keterangan}</td>
                                    <td>
                                        ${getStatusBadge(item.status)}
                                    </td>
                                    <td>
                                        ${getActioButton(item)}
                                    </td>`;
                tbody.appendChild(row);
            });
        }

        //fungsi status badge
        function getStatusBadge(status) {
            if (status === 'pending') {
                return '<span class="badge bg-warning text-white">' + status + '</span>';
            } else if (status === 'disetujui') {
                return '<span class="badge bg-success text-white">' + status + '</span>';
            } else if (status === 'ditolak') {
                return '<span class="badge bg-danger text-white">' + status + '</span>';
            } else {
                return ''; // Kondisi default jika tidak ada yang cocok
            }
        }

        //delete from search
        function getActioButton(item){
            if (item.status == 'pending'){
                return `
                <form action="/karyawan/formIzin/${item.id}" method="POST"
                                                class="d-inline" id="data-${item.id}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                    data-name="${item.jenis_izin}"
                                                    data-id="${item.id}"><i class='fa fa-trash'></i></button>
                                            </form>`
            }
        }

    </script>
@endsection
