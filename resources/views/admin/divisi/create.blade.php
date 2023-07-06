@extends('layouts.app')

@section('content')
<div class="card p-4">
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-4 text-gray-800">Divisi</h1>
        </div>
        <div class="col">
            <div class="text-end">
               <a href="{{ route('divisi.index') }}" class="btn btn-primary">
                     <i class="fas fa-arrow-left"></i> Kembali
                     </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('divisi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_divisi" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control @error('nama_divisi') is-invalid
                        @enderror" id="nama_divisi" placeholder="Nama Divisi" name="nama_divisi" required autofocus value="{{ old('nama_divisi') }}">
                        @error('nama_divisi')
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