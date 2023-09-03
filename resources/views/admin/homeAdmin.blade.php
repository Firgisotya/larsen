@extends('layouts.app')

@section('content')
    {{-- alert status login --}}
    @include('sweetalert::alert')

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="media-body text-left">
                                <h3 class="text-danger">{{ $countKaryawan }}</h3>
                                <span>Karyawan</span>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-users fa-2x text-danger float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="media-body text-left">
                                <h3 class="text-success">{{ $countDivisi }}</h3>
                                <span>Divisi</span>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-user fa-2x text-success float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="media-body text-left">
                                <h3 class="text-warning">{{ $countTugas }}</h3>
                                <span>Tugas</span>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-chart-pie fa-2x text-warning float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="media-body text-left">
                                <h3 class="text-primary">{{ $countDestinasi }}</h3>
                                <span>Destinasi</span>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-life-ring fa-2x text-primary float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row mb-2">
        <div class="col">
            <nav class="navbar navbar-light bg-white shadow-lg rounded">
                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <span class="navbar-brand mb-0 h1">Absensi Terbaru</span>
                </div>
            </nav>
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">NIK</th>
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
                                            <th scope="row">{{ $item->karyawan->nik }}</th>
                                            <td>{{ $item->karyawan->nama_karyawan }}</td>
                                            <td>
                                                @if ($item->izin)
                                                    {{ $item->izin->jenis_izin }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->jam_masuk }}</td>
                                            <td>{{ $item->lokasi_masuk }}</td>
                                            <td>
                                                <img src="{{ asset('storage/images/absensi/' . $item->foto_masuk) }}"
                                                    alt="" class="img-fluid">
                                            </td>
                                            <td>{{ $item->jam_pulang }}</td>
                                            <td>{{ $item->lokasi_pulang }}</td>
                                            <td>
                                                <img src="{{ asset('storage/images/absensi/' . $item->foto_pulang) }}"
                                                    alt="" class="img-fluid">
                                            </td>
                                            <td>{{ $item->telat }}</td>
                                            <td>

                                                
                                                <a href="{{ route('admin.presensi.show', $item->id) }}"
                                                    class="btn btn-warning">
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
    </div> --}}
@endsection
