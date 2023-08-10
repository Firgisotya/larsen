@extends('layouts.app')

@section('content')
    <div class="card p-4">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Ubah Password</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('pengelola.ubahPassword.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Password Lama</label>
                            <input type="password"
                                class="form-control @error('oldPassword') is-invalid
                        @enderror"
                                id="oldPassword" placeholder="Masukkan Password Lama" name="oldPassword" required autofocus
                                value="{{ old('oldPassword') }}">
                            @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Password Baru</label>
                            <input type="password"
                                class="form-control @error('newPassword') is-invalid
                        @enderror"
                                id="newPassword" placeholder="Masukkan Password Baru" name="newPassword" required autofocus
                                value="{{ old('newPassword') }}">
                            @error('newPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="newPasswordConfirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password"
                                class="form-control @error('newPasswordConfirmation') is-invalid
                        @enderror"
                                id="newPasswordConfirmation" placeholder="Masukkan Konfirmasi Password Baru" name="newPasswordConfirmation" required autofocus
                                value="{{ old('newPasswordConfirmation') }}">
                            @error('newPasswordConfirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
