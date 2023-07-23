@extends('layouts.app')

@section('style')
    <style>
        .circle {
            width: 250px;
            height: 200px;
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button class="btn btn-warning align-self-end mb-3" id="edit" onclick="edit()">Edit profile <i
                        class="fas fa-edit"></i></button>
                <button class="btn btn-danger align-self-end d-none mb-3" id="back" onclick="back()">Batal <i
                        class="fas fa-times"></i></button>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-3 col-sm-12 text-center pt-3">
                    <img src="@if ($user->karyawan->foto) {{ asset('storage/images/karyawan/' . $user->karyawan->foto) }}
                                @else
                                {{ asset('images/profile/user-1.jpg') }} @endif"
                        alt="" class="mb-3 img-fluid circle">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 text-start d-none" id="update">
                            <label for="formFile" class="form-label">Update Foto</label>
                            <img src="@if ($user->karyawan->foto) {{ asset('storage/images/karyawan/' . $user->karyawan->foto) }}
                            @else
                            {{ asset('images/profile/user-1.jpg') }} @endif"
                                class="img-preview mb-3 img-thumbnail circle"
                                alt="{{ $user->karyawan->nama_karyawan }}" height="200px" height="250px">
                            <input class="form-control" type="file" id="foto" name="foto"
                                onchange="previewImage()">
                            <input type="hidden" name="oldImage" value="{{ $user->karyawan->foto }}">
                        </div>
                </div>
                <div class="col-lg-9 col-sm-12">

                    <div class="bio">

                        <div class="card mb-3">
                            <div class="card-header">
                                Informasi Data Diri
                            </div>
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#preview-account">Data
                                            Personal
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#preview-personal">Data
                                            Akses
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane active fade show  profile-edit pt-3" id="preview-account">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Nama</label>
                                                    <h4>{{ $user->karyawan->nama_karyawan }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">NIK</label>
                                                    <h4>{{ $user->karyawan->nik }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Tempat Lahir</label>
                                                    <h4>{{ $user->karyawan->tempat_lahir }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Tanggal Lahir</label>
                                                    <h4>{{ $user->karyawan->tanggal_lahir }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Jenis Kelamin</label>
                                                    <h4>{{ $user->karyawan->jenis_kelamin }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">No Telepon</label>
                                                    <h4>{{ $user->karyawan->no_telepon }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Alamat</label>
                                                    <h4>{{ $user->karyawan->alamat }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <div class="card" style="border: none">
                                                    <label for="">Divisi</label>
                                                    <h4>{{ $user->karyawan->divisi->nama_divisi }}</h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade show profile-overview" id="preview-personal">
                                        @if ($user)
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12  mb-3">
                                                    <div class="card" style="border: none">
                                                        <label for="">Username</label>
                                                        <h4>{{ $user->username }}</h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12  mb-3">
                                                    <div class="card" style="border: none">
                                                        <label for="">Email</label>
                                                        <h4>{{ $user->email }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <h4 class="text-center mt-2">Data Akses Tidak Ada!</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form d-none">


                        <div class="card mb-3">
                            <div class="card-header">
                                Informasi Data Diri
                            </div>
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-edit">Data Personal
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Data Akses
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane active fade show  profile-edit pt-3" id="profile-edit">
                                        <h6>Data yang akan dimunculkan di akun anda</h6>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama Karyawan</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $user->karyawan->nama_karyawan }}" id="exampleInputEmail1"
                                                    name="nama_karyawan">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">NIK</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $user->karyawan->nik }}" id="exampleInputEmail1"
                                                    name="nik">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $user->karyawan->tempat_lahir }}" id="exampleInputEmail1"
                                                    name="tempat_lahir">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control"
                                                    value="{{ $user->karyawan->tanggal_lahir }}" id="exampleInputEmail1"
                                                    name="tanggal_lahir">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                                <select class="form-select" name="jenis_kelamin">
                                                    <option value="Laki-Laki"
                                                        {{ $user->karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                        Laki-Laki
                                                    </option>
                                                    <option value="Perempuan"
                                                        {{ $user->karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                        Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">No Telepon</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $user->karyawan->no_telepon }}" id="exampleInputEmail1"
                                                    name="no_telepon">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="alamat"
                                                    name="alamat" required autofocus>{{ isset($user) ? $user->karyawan->alamat : old('alamat') }}</textarea>
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-5">
                                                <label for="exampleInputEmail1" class="form-label">Divisi</label>
                                                <select
                                                    class="form-select @error('divisi_id') is-invalid
                                                    @enderror"
                                                    id="divisi_id" name="divisi_id" required autofocus
                                                    value="{{ old('divisi_id') }}">
                                                    <option value="">Pilih Divisi</option>
                                                    @foreach ($divisi as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $user->karyawan->divisi_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama_divisi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade show profile-overview" id="profile-overview">
                                        <h6>Data ini diperlukan untuk akses login</h6>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                                <input type="text" class="form-control" value="{{ $user->username }}"
                                                    id="exampleInputEmail1" name="username">
                                            </div>
                                            <div class="col-lg-6 col-sm-12  mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                                <input type="text" class="form-control" value="{{ $user->email }}"
                                                    id="exampleInputEmail1" name="email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit <i
                                    class="fas fa-check-circle"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const edit = () => {
            document.querySelector('.bio').classList.add('d-none');
            document.querySelector('.form').classList.remove('d-none');
            document.querySelector('#edit').classList.add('d-none');
            document.querySelector('#back').classList.remove('d-none');
            document.querySelector('#update').classList.remove('d-none');
            document.querySelector('#username').classList.add('d-none');
        }
        const back = () => {
            document.querySelector('.bio').classList.remove('d-none');
            document.querySelector('.form').classList.add('d-none');
            document.querySelector('#edit').classList.remove('d-none');
            document.querySelector('#back').classList.add('d-none');
            document.querySelector('#update').classList.add('d-none');
            document.querySelector('#username').classList.remove('d-none');
        }

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
