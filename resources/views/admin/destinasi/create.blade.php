@extends('layouts.app')

@section('content')
<div class="card p-4">
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-4 text-gray-800">Destinasi</h1>
        </div>
        <div class="col">
            <div class="text-end">
               <a href="{{ route('destinasi.index') }}" class="btn btn-primary">
                     <i class="fas fa-arrow-left"></i> Kembali
                     </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('destinasi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_destinasi" class="form-label">Nama Destinasi</label>
                        <input type="text" class="form-control @error('nama_destinasi') is-invalid
                        @enderror" id="nama_destinasi" placeholder="Nama Destinasi" name="nama_destinasi" required autofocus value="{{ old('nama_destinasi') }}">
                        @error('nama_destinasi')
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
