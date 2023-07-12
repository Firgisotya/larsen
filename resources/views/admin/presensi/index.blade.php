@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Manajemen Presensi</h1>
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
                                    <th scope="col">Izin</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Lokasi Masuk</th>
                                    <th scope="col">Foto Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Lokasi Pulang</th>
                                    <th scope="col">Foto Pulang</th>
                                    <th scope="col">Telat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $item->karyawan->nama_karyawan }}</td>
                                        <td>{{ ($item->izin == '') ? null : 1  }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jam_masuk }}</td>
                                        <td>{{ $item->lokasi_masuk }}</td>
                                        <td>
                                            <img src="{{ asset('storage/images/absensi/' . $item->foto_masuk) }}" alt=""
                                                class="img-fluid">
                                        </td>
                                        <td>{{ $item->jam_pulang }}</td>
                                        <td>{{ $item->lokasi_pulang }}</td>
                                        <td>
                                            <img src="{{ asset('storage/images/absensi/' . $item->foto_pulang) }}" alt=""
                                                class="img-fluid">
                                        </td>
                                        <td>{{ $item->telat }}</td>
                                        <td>

                                                {{-- detail --}}
                                                <a href="{{ route('admin.presensi.show', $item->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Tampilkan pagination links -->
                        <div class="d-flex justify-content-center">
                            {{ $absensi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
