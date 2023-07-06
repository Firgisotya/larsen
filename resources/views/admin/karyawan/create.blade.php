@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Karyawan</h1>
            </div>
            <div class="col">
                <div class="text-end">
                    <a href="{{ route('karyawan.index') }}" class="btn btn-primary">
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
                    <form action="{{ route('karyawan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text"
                                class="form-control @error('nik') is-invalid
                        @enderror"
                                id="nik" placeholder="NIK" name="nik" required autofocus
                                value="{{ old('nik') }}">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text"
                                class="form-control @error('nama_karyawan') is-invalid
                        @enderror"
                                id="nama_karyawan" placeholder="Nama Karyawan" name="nama_karyawan" required autofocus
                                value="{{ old('nama_karyawan') }}">
                            @error('nama_karyawan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text"
                                class="form-control @error('username') is-invalid
                        @enderror"
                                id="username" placeholder="Username" name="username" required autofocus
                                value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid
                        @enderror"
                                id="email" placeholder="email" name="email" required autofocus
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text"
                                class="form-control @error('tempat_lahir') is-invalid
                        @enderror"
                                id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" required autofocus
                                value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date"
                                class="form-control @error('tanggal_lahir') is-invalid
                        @enderror"
                                id="tanggal_lahir" placeholder="Tempat Lahir" name="tanggal_lahir" required autofocus
                                value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid
                        @enderror"
                                id="jenis_kelamin" name="jenis_kelamin" required autofocus value="{{ old('jenis_kelamin') }}">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid
                        @enderror" id="alamat"
                                placeholder="alamat" name="alamat" required autofocus value="{{ old('alamat') }}"></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text"
                                class="form-control @error('no_telepon') is-invalid
                        @enderror"
                                id="no_telepon" placeholder="Nomor Telepon" name="no_telepon" required autofocus
                                value="{{ old('no_telepon') }}">
                            @error('no_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="divisi_id" class="form-label">Divisi</label>
                            <select class="form-select @error('divisi_id') is-invalid
                        @enderror"
                                id="divisi_id" name="divisi_id" required autofocus value="{{ old('divisi_id') }}">
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_divisi }}</option>
                                @endforeach
                            </select>
                            @error('divisi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                            <input type="text"
                                class="form-control @error('tahun_masuk') is-invalid
                        @enderror"
                                id="tahun_masuk" placeholder="Tahun Masuk" name="tahun_masuk" required autofocus
                                value="{{ old('tahun_masuk') }}">
                            @error('tahun_masuk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"
                                class="form-control @error('password') is-invalid
                        @enderror"
                                id="password" placeholder="Password" name="password" required autofocus
                                value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmation_password" class="form-label">Konfirmasi Password</label>
                            <input type="password"
                                class="form-control @error('confirmation_password') is-invalid
                        @enderror"
                                id="confirmation_password" placeholder="Konfirmasi Password" name="confirmation_password"
                                required autofocus value="{{ old('confirmation_password') }}">
                            @error('confirmation_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid
                        @enderror"
                                id="role" name="role" required autofocus value="{{ old('role') }}">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                            </select>
                            @error('role')
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
