@extends('layouts.app')

@section('content')
<div class="card p-4">
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-4 text-gray-800">Role Permission</h1>
        </div>
        <div class="col">
            <div class="text-end">
               <a href="{{ route('role.index') }}" class="btn btn-primary">
                     <i class="fas fa-arrow-left"></i> Kembali
                     </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="nama_role" class="form-label">Nama Role</label>
                        <input type="text" class="form-control @error('nama_role') is-invalid
                        @enderror" id="nama_role" placeholder="Nama Role" name="nama_role" required autofocus value="{{ old('nama_role', $role->nama_role) }}">
                        @error('nama_role')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                      </div>
                      <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
