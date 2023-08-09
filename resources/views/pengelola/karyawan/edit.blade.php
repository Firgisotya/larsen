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
                    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text"
                                class="form-control @error('nik') is-invalid
                        @enderror"
                                id="nik" placeholder="NIK" name="nik" required autofocus
                                value="{{ old('nik', $karyawan->nik) }}">
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
                                value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}">
                            @error('nama_karyawan')
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
                                value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}">
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
                                value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}">
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
                                id="jenis_kelamin" name="jenis_kelamin" required autofocus
                                value="{{ old('jenis_kelamin') }}">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" @if (old('jenis_kelamin', $karyawan->jenis_kelamin) === 'Laki-Laki') selected @endif>Laki-Laki
                                </option>
                                <option value="Perempuan" @if (old('jenis_kelamin', $karyawan->jenis_kelamin) === 'Perempuan') selected @endif>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="alamat" name="alamat"
                                required autofocus>{{ isset($karyawan) ? $karyawan->alamat : old('alamat') }}</textarea>
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
                                value="{{ old('no_telepon', $karyawan->no_telepon) }}">
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
                                    <option value="{{ $item->id }}" {{ $karyawan->divisi_id == $item->id ? 'selected' : '' }}>{{ $item->nama_divisi }}</option>
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
                                value="{{ old('tahun_masuk', $karyawan->tahun_masuk) }}">
                            @error('tahun_masuk')
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
                                @foreach ($role as $item)
                                    <option value="{{ $item->id }}" {{ $user->role_id == $item->id ? 'selected' : '' }}>{{ $item->nama_role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label d-block">Foto Karyawan</label>
                            <img src="@if ($karyawan -> foto)
                            {{ asset('storage/images/karyawan/'.$karyawan->foto) }}
                        @endif" class="img-preview mb-3 " alt="{{ $karyawan -> nama_karyawan }}" height="200px"
                              height="250px">
                            <input class="form-control  @error('foto') is-invalid
                                                @enderror" type="file" id="foto" name="foto" onchange="previewImage()">
                            @error('foto')
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

@section('script')
    <script>
        function previewImage() {
            const foto = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
