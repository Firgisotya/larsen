@extends('layouts.mainLogin')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
data-sidebar-position="fixed" data-header-position="fixed">
<div
    class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ asset('images/logos/dark-logo.svg') }}" width="180" alt="">
                        </a>
                        <p class="text-center">Your Social Campaigns</p>
                        <form method="POST" action="{{ route('resetPassword.submit') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $encryptedUserId }}">

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid
                            @enderror"
                                    id="password" placeholder="Masukkan Password Baru" name="password" required autofocus
                                    value="{{ old('password') }}">
                                @error('password')
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

                            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Confirm Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
