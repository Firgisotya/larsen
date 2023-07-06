@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Karyawan</h1>
            </div>
            <div class="col">
                <div class="text-end">
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
                                        <td>{{ $item->divisi->nama_divisi }}</td>
                                        <td>{{ $item->tempat_lahir }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>{{ $item->tahun_masuk }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                {{-- edit --}}
                                                <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- detail --}}
                                                <a href="{{ route('karyawan.show', $item->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- delete --}}
                                                <a href="{{ route('karyawan.destroy', $item->id) }}" class="btn btn-danger"
                                                    onclick="confirmation(event)">
                                                    <i class="fas fa-trash"></i>
                                                </a>
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
    </div>
    @include('sweetalert::alert')



@section('script')
@endsection
@endsection
