@extends('layouts.app')

@section('content')
    <div class="card mb-3 shadow-lg">
        <div class="card-header d-flex justify-content-between">
            Detail Absensi
            <a href="{{ route('admin.presensi.index') }}" class="btn btn-primary">Kembali</a>
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

                                        <input type="hidden" id="latMasuk" value="{{ $masuk_pulang['latMasuk'] }}" />
                                        <input type="hidden" id="longMasuk" value="{{ $masuk_pulang['longMasuk'] }}" />

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
                            <h5>Lokasi Masuk :</h5>
                            <div id="mapMasuk" style="height: 400px"></div>
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
                                            <td>
                                                <h5>
                                                    <input type="hidden" id="latPulang"
                                                        value="{{ $masuk_pulang['latPulang'] }}" />
                                                    <input type="hidden" id="longPulang"
                                                        value="{{ $masuk_pulang['longPulang'] }}" />

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
                            <h5>Lokasi Pulang :</h5>
                            <div id="mapPulang" style="height: 400px"/div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            function initMap() {
                // Retrieve the latitude and longitude values for masuk and pulang
                var latMasuk = parseFloat(document.getElementById('latMasuk').value);
                var longMasuk = parseFloat(document.getElementById('longMasuk').value);
                var latPulang = parseFloat(document.getElementById('latPulang').value);
                var longPulang = parseFloat(document.getElementById('longPulang').value);

                // Create a map for masuk
                var mapMasuk = L.map('mapMasuk').setView([latMasuk, longMasuk], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapMasuk);
                var masukIcon = L.icon({
                    iconUrl: '{{ asset('images/1.png') }}',
                    iconSize: [40, 45],
                    iconAnchor: [12, 41],
                    popupAnchor: [0, -41]
                });
                L.marker([latMasuk, longMasuk], {
                    icon: masukIcon
                }).addTo(mapMasuk);


                // Create a map for pulang
                var mapPulang = L.map('mapPulang').setView([latPulang, longPulang], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapPulang);
                var pulangIcon = L.icon({
                    iconUrl: '{{ asset('images/1.png') }}',
                    iconSize: [40, 45],
                    iconAnchor: [12, 41],
                    popupAnchor: [0, -41]
                });
                L.marker([latPulang, longPulang], {
                    icon: pulangIcon
                }).addTo(mapPulang);


                $.ajax({
                    url: '{{ route('lokasiKantor') }}',
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(i, item) {
                            console.log(item);
                            var icon = L.icon({
                                iconUrl: '{{ asset('images/2.png') }}',
                                iconSize: [40, 45],
                                iconAnchor: [12, 41],
                                popupAnchor: [0, -41]
                            });
                            var marker = L.marker([item.latitude, item.longitude], {
                                    icon: icon
                                })
                                .bindPopup('Nama Kantor : ' + item.nama_kantor + '<br>' +
                                    'Alamat Kantor :' + item.alamat_kantor);
                            var radius = L.circle([item.latitude, item.longitude], {
                                color: 'red',
                                fillColor: '#f03',
                                fillOpacity: 0.5,
                                radius: 100
                            });

                            if (i % 2 == 0) { // Marker masuk
                                marker.addTo(mapMasuk);
                                radius.addTo(mapMasuk);
                            } else { // Marker pulang
                                marker.addTo(mapPulang);
                                radius.addTo(mapPulang);
                            }
                        });
                    }
                })
            }

            // Initialize the map
            window.addEventListener('DOMContentLoaded', initMap);
        </script>
    @endsection
