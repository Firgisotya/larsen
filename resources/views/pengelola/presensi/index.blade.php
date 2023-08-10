@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Manajemen Presensi</h1>
            </div>
            <div class="d-flex justify-content-end mt-3 gap-2">
                    <a href="{{ route('pengelola.presensi.index') }}" class="btn btn-primary"><i class="fas fa-sync"></i>
                        Reset</a>

                    <a href="/pengelola/presensi/export-pdf" class="btn btn-primary"><i class="fas fa-file-pdf"></i>
                        Export PDF</a>

                    <a href="/pengelola/presensi/export-excel" class="btn btn-primary"><i class="fas fa-file-excel"></i>
                        Export Excel</a>

            </div>
        </div>

        <div class="row">
            <form id="filterForm" class="d-flex justify-content-between gap-2">
            <div class="col-6">
                <label for="tanggalFilter" class="form-label">Filter Tanggal:</label>
                <input type="date" id="tanggalFilter" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
            </div>
            <div class="col-6">
                <label for="namaFilter" class="form-label">Filter Nama:</label>
                <select name="karyawan" id="namaFilter" class="form-control">
                    <option value="">-- Pilih Nama --</option>
                    @foreach ($karyawan as $item)
                    <option value="{{ $item->id }}"
                        {{ request('karyawan') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_karyawan }}</option>
                    @endforeach
                </select>
            </div>
            </form>
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

@section('script')
<script>
    $(document).ready(function() {
        $('#filterForm input').on('change', function() {
            $('#filterForm').submit();
        });

        $('#filterForm select').on('change', function() {
            $('#filterForm').submit();
        });
    });
</script>

@endsection
