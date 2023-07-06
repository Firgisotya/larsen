@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Tugas</h1>
            </div>
            <div class="col">
                <div class="text-end">
                    <a href="{{ route('tugas.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    <form action="{{ route('tugas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_tugas" class="form-label">Nama Tugas</label>
                            <input type="text"
                                class="form-control @error('nama_tugas') is-invalid
                        @enderror"
                                id="nama_tugas" placeholder="Nama Tugas" name="nama_tugas" required autofocus
                                value="{{ old('nama_tugas') }}">
                            @error('nama_tugas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Karyawan</label>
                            <select class="form-select @error('karyawan_id') is-invalid
                        @enderror"
                                id="karyawan_id" name="karyawan_id" required autofocus value="{{ old('karyawan_id') }}">
                                <option value="">Pilih Karyawan</option>
                                @foreach ($karyawan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_karyawan }}</option>
                                @endforeach
                            </select>
                            @error('karyawan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="destinasi_id" class="form-label">Destinasi</label>
                            <select class="form-select @error('destinasi_id') is-invalid
                        @enderror"
                                id="destinasi_id" name="destinasi_id" required autofocus value="{{ old('destinasi_id') }}">
                                <option value="">Pilih Destinasi</option>
                                @foreach ($destinasi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_destinasi }}</option>
                                @endforeach
                            </select>
                            @error('destinasi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_tugas" class="form-label">Deskripsi Tugas</label>
                            <textarea class="form-control @error('deskripsi_tugas') is-invalid
                        @enderror" id="deskripsi_tugas"
                                placeholder="Deskripsi Tugas" name="deskripsi_tugas" required autofocus value="{{ old('deskripsi_tugas') }}"></textarea>
                            @error('deskripsi_tugas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date"
                                class="form-control @error('tanggal') is-invalid
                        @enderror"
                                id="tanggal" placeholder="Tanggal" name="tanggal" required autofocus
                                value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time"
                                class="form-control @error('jam_mulai') is-invalid
                        @enderror"
                                id="jam_mulai" placeholder="Jam Mulai" name="jam_mulai" required autofocus
                                value="{{ old('jam_mulai') }}">
                            @error('jam_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time"
                                class="form-control @error('jam_selesai') is-invalid
                        @enderror"
                                id="jam_selesai" placeholder="Jam Selesai" name="jam_selesai" required autofocus
                                value="{{ old('jam_selesai') }}">
                            @error('jam_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
