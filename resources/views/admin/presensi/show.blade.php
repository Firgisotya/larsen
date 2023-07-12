@extends('layouts.app')

@section('content')
    <div class="card mb-3 shadow-lg">
        <div class="card-header">
            Detail Absensi
        </div>
        <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                    <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#masuk">Absen Masuk
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#pulang">Absen Pulang
                    </button>
                </li>
            </ul>
            <div class="tab-content pt-2">
                <div class="tab-pane active fade show  profile-edit pt-3" id="masuk">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h1 class="d-inline">Detail Absen Masuk</h1>
                                </div>
                            </div>
                            <hr>
                            <div class="col-6">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <h5>Nama Karyawan </h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>{{ $absensi->karyawan->nama_karyawan }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Izin </h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    {{ $absensi->izin == '' ? null : 1 }}
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Tanggal</h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    {{ $absensi->tanggal }}
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Jam Masuk</h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    {{ $absensi->jam_masuk }}
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Lokasi Masuk</h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    <input type="hidden" id="latMasuk" value="{{ $masuk_pulang['latMasuk'] }}" />
                                                    <input type="hidden" id="longMasuk" value="{{ $masuk_pulang['longMasuk'] }}" />
                                                    <button type="button" class="btn btn-secondary" onclick="showMapMasuk()">tes</button>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Telat</h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    @if (!$absensi->telat)
                                                        <span class="badge bg-success">Tidak Telat</span>
                                                    @elseif ($absensi->telat)
                                                        <span class="badge bg-danger">{{ $absensi->telat }}</span>
                                                    @endif
                                                </h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('storage/images/absensi/' . $absensi->foto_masuk) }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="row">
                            <div id="mapMasuk"></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show profile-overview" id="pulang">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h1 class="d-inline">Detail Absen Masuk</h1>
                                </div>
                            </div>
                            <hr>
                            <div class="col-6">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <h5>Nama Karyawan </h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>{{ $absensi->karyawan->nama_karyawan }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Izin </h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    {{ $absensi->izin == '' ? null : 1 }}
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Tanggal</h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    {{ $absensi->tanggal }}
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Jam Pulang</h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    {{ $absensi->jam_pulang }}
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <h5>Lokasi Pulang</h5>
                                            </th>
                                            <th>:</th>
                                            <td>
                                                <h5>
                                                    <input type="hidden" id="latPulang" value="{{ $masuk_pulang['latPulang'] }}" />
                                                    <input type="hidden" id="longPulang" value="{{ $masuk_pulang['longPulang'] }}" />
                                                    
                                                </h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('storage/images/absensi/' . $absensi->foto_pulang) }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="row">
                            <div id="mapPulang"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        
        var mymap = L.map('mapMasuk').setView([51.505, -0.09], 13);
        console.log(document.getElementById('mapMasuk'));

       L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

        function showMapMasuk() {
            var latMasuk = document.getElementById('latMasuk').value;
            var longMasuk = document.getElementById('longMasuk').value;
            console.log(latMasuk, longMasuk);

            var marker = L.marker([latMasuk, longMasuk]).addTo(map);

            marker.bindPopup("<b>Lokasi Masuk</b><br />" + latMasuk + ", " + longMasuk).openPopup();



        }
    </script>
@endsection
