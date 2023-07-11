@extends('layouts.app')

@section('content')
<div class="card p-4">
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-4 text-gray-800">Form Izin</h1>
        </div>
        <div class="col">
            <div class="text-end">
               <a href="{{ route('formIzin.index') }}" class="btn btn-primary">
                     <i class="fas fa-arrow-left"></i> Kembali
                     </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('formIzin.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis_izin" class="form-label">Jenis Izin</label>
                        <select class="form-select @error('jenis_izin') is-invalid
                        @enderror"
                                id="jenis_izin" name="jenis_izin" required autofocus value="{{ old('jenis_izin') }}">
                                <option value="">Pilih Jenis Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Tugas Luar">Tugas Luar</option>
                            </select>
                        @error('jenis_izin')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                    @enderror
                      </div>
                      <div class="mb-3">
                        <label for="tanggal_izin" class="form-label">Tanggal Lahir</label>
                            <input type="date"
                                class="form-control @error('tanggal_izin') is-invalid
                        @enderror"
                                id="tanggal_izin" placeholder="Tempat Izin" name="tanggal_izin" required autofocus
                                value="{{ old('tanggal_izin') }}">
                            @error('tanggal_izin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                      </div>
                      <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid
                    @enderror" id="keterangan"
                            placeholder="keterangan" name="keterangan" required autofocus value="{{ old('keterangan') }}"></textarea>
                        @error('keterangan')
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