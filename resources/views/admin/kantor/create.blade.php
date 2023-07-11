@extends('layouts.app')

@section('content')
    <div class="card p-4">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Kantor</h1>
            </div>
            <div class="col">
                <div class="text-end">
                    <a href="{{ route('lokasiKantor.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('lokasiKantor.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_kantor" class="form-label">Nama Kantor</label>
                            <input type="text"
                                class="form-control @error('nama_kantor') is-invalid
                        @enderror"
                                id="nama_kantor" placeholder="Nama Kantor" name="nama_kantor" required autofocus
                                value="{{ old('nama_kantor') }}">
                            @error('nama_kantor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat_kantor" class="form-label">Alamat Kantor</label>
                            <textarea class="form-control @error('alamat_kantor') is-invalid
                            @enderror"
                                    id="alamat_kantor" placeholder="Alamat Kantor" name="alamat_kantor" required autofocus
                                    value="{{ old('alamat_kantor') }}" >

                            </textarea>
                            @error('alamat_kantor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text"
                                class="form-control @error('latitude') is-invalid
                        @enderror"
                                id="latitude" placeholder="Latitude" name="latitude" required autofocus
                                value="{{ old('latitude') }}">
                            @error('latitude')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text"
                                class="form-control @error('longitude') is-invalid
                        @enderror"
                                id="longitude" placeholder="Longitude" name="longitude" required autofocus
                                value="{{ old('longitude') }}">
                            @error('longitude')
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
