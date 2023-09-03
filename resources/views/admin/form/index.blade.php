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
                        <input id="search" type="text" class="form-control" placeholder="Cari Form Izin"
                            aria-label="Cari Form Izin" aria-describedby="basic-addon2">
                    </div>
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
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Jenis Izin</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($form as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->karyawan->nama_karyawan }}</td>
                                    <td>{{ $item->jenis_izin }}</td>
                                    <td>{{ $item->tanggal_izin }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <span class="badge bg-warning text-white">{{ $item->status }}</span>
                                        @elseif ($item->status == 'diterima')
                                            <span class="badge bg-success text-white">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <form action="{{ route('admin.form.terima', $item->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"><i
                                                        class="fa-regular fa-square-check"></i></button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Tampilkan pagination links -->
                    <div class="d-flex justify-content-center">
                        {{ $form->links() }}
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
                fetch(`/search-izin?query=${query}`)
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
        <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->karyawan->nama_karyawan }}</td>
                                    <td>{{ $item->jenis_izin }}</td>
                                    <td>{{ $item->tanggal_izin }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <span class="badge bg-warning text-white">{{ $item->status }}</span>
                                        @elseif ($item->status == 'diterima')
                                            <span class="badge bg-success text-white">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <form action="{{ route('admin.form.terima', $item->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"><i
                                                        class="fa-regular fa-square-check"></i></button>
                                            </form>
                                        @endif

                                    </td>
    `;
                tbody.appendChild(row);
            });
        }

    </script>
@endsection
