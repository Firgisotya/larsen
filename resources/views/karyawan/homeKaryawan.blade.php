@extends('layouts.app')

@section('style')
    <style>
        .circle {
            height: 50px;
            width: 50px;
            background-color: #555;
            border-radius: 50%;
        }

        #map {
            height: 400px;
        }
    </style>
@endsection

@section('content')

    {{-- alert status login --}}
    @include('sweetalert::alert')


    {{-- absen --}}
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- masuk --}}
        <div class="col-6">
            <!-- Button trigger modal -->
            <div data-bs-toggle="modal" data-bs-target="#masuk" onclick="getLocationMasuk()">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title text-primary d-flex justify-content-center">
                            <i class="fas fa-camera-alt fa-5x"></i>
                        </h5>
                        <h2 class="card-text text-primary d-flex justify-content-center">Absen Masuk</h2>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="masuk" tabindex="-1" aria-labelledby="masukLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Absen Masuk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div id="lokasi" class="d-flex flex-column justify-content-center mb-6">
                                <h3 class="text-center">Lokasi Anda</h3>
                                <div class="d-flex justify-content-center gap-2">
                                    Latitude: <span id="latitudeMasuk" name="latitudeMasuk"></span>
                                    Longitude: <span id="longitudeMasuk" name="longitudeMasuk"></span>
                                </div>
                            </div>

                            <div id="webcam-masuk" class="d-flex justify-content-center">
                                <video id="video-masuk" width="100%" height="100%" autoplay playsinline></video>
                                {{-- <div class="row">
                                    <img class="img-fluid mb-3 col-sm-5" id="imagePreview-masuk">
                                    <div class="custom-file ">
                                        <input type="file" accept="image/*" capture="camera" id="uploadInput-masuk"
                                            class="custom-file-input" onchange="previewImage('masuk')">
                                        <label class="custom-file-label" for="uploadInput-masuk"></label>
                                    </div>
                                </div> --}}
                            </div>
                            <div id="captured-image-masuk-container" style="display: none;">
                                <img id="captured-image-masuk" width="100%" height="100%" src=""
                                    alt="Captured Image">
                            </div>
                            <input id="captured-image-input-masuk" type="hidden" name="webcam-masuk" value="">
                            <input type="hidden" name="waktu-masuk" value="masuk">
                            <div class="col-md-12 text-center">
                                <br />
                                <button id="capture-masuk" class="btn btn-primary" onclick="capture('masuk')">Ambil
                                    Foto</button>
                                <button id="reset-masuk" class="btn btn-danger" style="display: none;"
                                    onclick="resetCapture('masuk')">Reset</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn-masuk" onclick="submitAbsenMasuk()"
                                data-bs-dismiss="modal">Absen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- pulang --}}
        <div class="col-6">
            <!-- Button trigger modal -->
            <div data-bs-toggle="modal" data-bs-target="#pulang" onclick="getLocationPulang()">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title text-primary d-flex justify-content-center">
                            <i class="fas fa-camera-alt fa-5x"></i>
                        </h5>
                        <h2 class="card-text text-primary d-flex justify-content-center">Absen Pulang</h2>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="pulang" tabindex="-1" aria-labelledby="pulangLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Absen Pulang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div id="lokasi" class="d-flex flex-column justify-content-center mb-4">
                                <h3 class="text-center">Lokasi Anda</h3>
                                <div class="d-flex justify-content-center gap-2">
                                    Latitude: <span id="latitudePulang" name="latitudePulang"></span>
                                    Longitude: <span id="longitudePulang" name="longitudePulang"></span>
                                </div>
                            </div>

                            <div id="webcam-pulang" class="d-flex justify-content-center">
                                <video id="video-pulang" width="100%" height="100%" autoplay playsinline></video>
                                {{-- <div class="row">
                                    <img class="img-fluid mb-3 col-sm-5" id="imagePreview-pulang">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" capture="camera" id="uploadInput-pulang"
                                            class="custom-file-input" onchange="previewImage('pulang')">
                                        <label class="custom-file-label" for="uploadInput-pulang"></label>
                                    </div>
                                </div> --}}
                            </div>
                            <div id="captured-image-pulang-container" style="display: none;">
                                <img id="captured-image-pulang" width="100%" height="100%" src=""
                                    alt="Captured Image">
                            </div>
                            <input id="captured-image-input-pulang" type="hidden" name="webcam-pulang" value="">
                            <input type="hidden" name="waktu-pulang" value="pulang">
                            <div class="col-md-12 text-center">
                                <br />
                                <button id="capture-pulang" class="btn btn-primary" onclick="capture('pulang')">Ambil
                                    Foto</button>
                                <button id="reset-pulang" class="btn btn-danger" style="display: none;"
                                    onclick="resetCapture('pulang')">Reset</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn-pulang" onclick="submitAbsenPulang()"
                                data-bs-dismiss="modal">Absen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Status Absen Hari ini {{ $hari_ini }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Absen Masuk</h5>
                                    @if ($cek == null)
                                        <span class="badge bg-danger">Belum Absen</span>
                                    @elseif ($cek != null)
                                        @if ($cek->lokasi_masuk == null && $cek->foto_masuk == null)
                                            <span class="badge bg-danger">Belum Absen</span>
                                        @elseif ($cek->lokasi_masuk != null && $cek->foto_masuk != null)
                                            <span class="badge bg-success">Sudah Absen</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Absen Pulang</h5>
                                    @if ($cek == null)
                                        <span class="badge bg-danger">Belum Absen</span>
                                    @elseif ($cek != null)
                                        @if ($cek->lokasi_pulang == null && $cek->foto_pulang == null)
                                            <span class="badge bg-danger">Belum Absen</span>
                                        @elseif ($cek->lokasi_pulang != null && $cek->foto_pulang != null)
                                            <span class="badge bg-success">Sudah Absen</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- informasi --}}
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="media-body text-left">
                                <h3 class="text-danger">{{ $countAbsen }}</h3>
                                <span>Absen</span>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-camera-alt fa-2x text-danger float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="media-body text-left">
                                <h3 class="text-success">{{ $countIzin }}</h3>
                                <span>Izin</span>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-user fa-2x text-success float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="media-body text-left">
                                <h3 class="text-warning">{{ $countTugas }}</h3>
                                <span>Tugas</span>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-chart-pie fa-2x text-warning float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-lg">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="media-body text-left">
                                <h3 class="text-primary">{{ $countTelat }}</h3>
                                <span>Telat</span>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-life-ring fa-2x text-primary float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- map --}}
    <div class="card">
        <h5 class="card-header">Lokasi Kantor</h5>
        <div class="card-body">
            <div id="map"></div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection

@section('script')
    <script>
        // Mendapatkan elemen modal body
        var modalBodyMasuk = document.querySelector("#masuk .modal-body");
        var modalBodyPulang = document.querySelector("#pulang .modal-body");

        // Mendapatkan elemen video dan tombol ambil foto
        var videoMasuk = document.getElementById("video-masuk");
        var captureButtonMasuk = document.getElementById("capture-masuk");
        var videoPulang = document.getElementById("video-pulang");
        var captureButtonPulang = document.getElementById("capture-pulang");
        var btnMasuk = document.getElementById("btn-masuk");
        var btnPulang = document.getElementById("btn-pulang");

        // cek absensi menggunakan ajax

        $.ajax({
            url: '{{ route('karyawan.absensi.checkAbsen') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
            }
        });

        // Fungsi untuk mendapatkan waktu saat ini dalam format jam dan menit
        function getCurrentTime() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();
            return hours * 60 + minutes; // Menghitung waktu dalam menit
        }

        // Fungsi untuk memeriksa waktu dan mengaktifkan/menonaktifkan tombol absen
        function checkAbsenAvailability() {
            const currentDate = new Date();
            const currentTime = (currentDate.getHours() < 10 ? "0" : "") + currentDate.getHours() +
                ":" + (currentDate.getMinutes() < 10 ? "0" : "") + currentDate.getMinutes();

            // Lakukan permintaan AJAX untuk mengambil waktu masuk dan pulang dari server
            fetch('/lokasi') // Ganti dengan URL yang sesuai di server Anda
                .then(response => response.json())
                .then(data => {

                    // console.log("data : ", data);
                    const masukStartTime = data.map(item => item
                        .jam_masuk); // Ganti dengan nama kolom yang sesuai di respons JSON
                    const masukEndTime = masukStartTime.map(startTime => {
                        const jamMasuk = new Date(
                            `01/01/2023 ${startTime}`
                        ); // Menggunakan tanggal sembarang, karena hanya peduli dengan jam
                        jamMasuk.setMinutes(jamMasuk.getMinutes() + 60); //09:00

                        // Mengubah format jam ke format yang sama dengan masukStartTime
                        const formattedEndTime = (jamMasuk.getHours() < 10 ? "0" : "") + jamMasuk.getHours() +
                            ":" + (jamMasuk.getMinutes() < 10 ? "0" : "") + jamMasuk.getMinutes();

                        return formattedEndTime;
                    });
                    const pulangStartTime = data.map(item => item
                        .jam_pulang); // Ganti dengan nama kolom yang sesuai di respons JSON
                    const pulangEndTime = pulangStartTime.map(startTime => {
                        const jamPulang = new Date(`01/01/2023 ${startTime}`);
                        jamPulang.setMinutes(jamPulang.getMinutes() + 60);

                        const formattedEndTime = (jamPulang.getHours() < 10 ? "0" : "") + jamPulang.getHours() +
                            ":" + (jamPulang.getMinutes() < 10 ? "0" : "") + jamPulang.getMinutes();

                        return formattedEndTime;
                    })

                    // console.log("Current Time:", currentTime);
                    // console.log("Masuk Start Time:", masukStartTime);
                    // console.log("Masuk End Time:", masukEndTime);
                    // console.log("Pulang Start Time:", pulangStartTime);
                    // console.log("Pulang End Time:", pulangEndTime);

                    // Memeriksa apakah waktu saat ini diizinkan untuk absen masuk
                    if (masukStartTime.some(jamMasuk => currentTime >= jamMasuk)) {
                        btnMasuk.removeAttribute("disabled"); // Mengaktifkan tombol absen masuk
                    } else {
                        btnMasuk.setAttribute("disabled", "true"); // Menonaktifkan tombol absen masuk
                    }

                    // Memeriksa apakah waktu saat ini diizinkan untuk absen pulang
                    if (pulangStartTime.some(jamPulang => currentTime >= jamPulang)) {
                        btnPulang.removeAttribute("disabled"); // Mengaktifkan tombol absen pulang
                    } else {
                        btnPulang.setAttribute("disabled", "true"); // Menonaktifkan tombol absen pulang
                    }
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                });

            // Waktu yang diizinkan untuk absen masuk (dalam menit)
            // const masukStartTime = 10 * 60; // 10:00 AM
            // const masukEndTime = 11 * 60; // 11:15 AM

            // // Waktu yang diizinkan untuk absen pulang (dalam menit)
            // const pulangStartTime = 17 * 60; // 5:00 PM
            // const pulangEndTime = 18 * 60; // 6:15 PM

            // console.log("Current Time:", currentTime);
            // console.log("Masuk Start Time:", masukStartTime);
            // console.log("Masuk End Time:", masukEndTime);

            // // Mendapatkan tombol absen masuk dan pulang
            // const btnMasuk = document.getElementById("btn-masuk");
            // const btnPulang = document.getElementById("btn-pulang");

            // if (btnMasuk && btnPulang) {
            //     // Memeriksa apakah waktu saat ini diizinkan untuk absen masuk
            //     if (currentTime >= masukStartTime && currentTime <= masukEndTime) {
            //         btnMasuk.removeAttribute("disabled"); // Mengaktifkan tombol absen masuk
            //     } else {
            //         btnMasuk.setAttribute("disabled", "true"); // Menonaktifkan tombol absen masuk
            //     }

            //     // Memeriksa apakah waktu saat ini diizinkan untuk absen pulang
            //     if (currentTime >= pulangStartTime && currentTime <= pulangEndTime) {
            //         btnPulang.removeAttribute("disabled"); // Mengaktifkan tombol absen pulang
            //     } else {
            //         btnPulang.setAttribute("disabled", "true"); // Menonaktifkan tombol absen pulang
            //     }
            // }
        }

        // Memanggil fungsi checkAbsenAvailability saat halaman dimuat
        setInterval(checkAbsenAvailability, 2000);

        // cek support camera
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            console.log('MediaDevices API supported');
        } else {
            console.log('MediaDevices API not supported');
        }


        // Fungsi untuk mengambil akses ke kamera
        function getCamera(waktu) {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    var videoElement = document.getElementById('video-' + waktu);
                    videoElement.srcObject = stream;
                })
                .catch(function(error) {
                    console.log('Error accessing camera: ', error);
                });
        }

        // Fungsi untuk mengambil foto
        function capture(waktu) {
            var videoElement = document.getElementById('video-' + waktu);
            var canvasElement = document.createElement('canvas');
            canvasElement.width = videoElement.videoWidth;
            canvasElement.height = videoElement.videoHeight;

            var canvasContext = canvasElement.getContext('2d');
            canvasContext.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);

            var dataURL = canvasElement.toDataURL('image/jpeg');

            document.getElementById('video-' + waktu).style.display = 'none';
            document.getElementById('captured-image-' + waktu).src = dataURL;
            document.getElementById('captured-image-input-' + waktu).value = dataURL;
            document.getElementById('captured-image-' + waktu + '-container').style.display = 'block';
            document.getElementById('capture-' + waktu).style.display = 'none';
            document.getElementById('reset-' + waktu).style.display = 'inline-block';
        }

        // Fungsi untuk mereset foto
        function resetCapture(waktu) {
            document.getElementById('video-' + waktu).style.display = 'block';
            document.getElementById('captured-image-' + waktu + '-container').style.display = 'none';
            document.getElementById('capture-' + waktu).style.display = 'inline-block';
            document.getElementById('reset-' + waktu).style.display = 'none';
            document.getElementById('captured-image-input-' + waktu).value = '';
        }

        // Panggil fungsi getCameraMasuk saat modal ditampilkan
        $('#masuk').on('shown.bs.modal', function() {
            getCamera('masuk');
        });
        // Panggil fungsi getCameraPulang saat modal ditampilkan
        $('#pulang').on('shown.bs.modal', function() {
            getCamera('pulang');
        });

        // Panggil fungsi reseresetCapturek'masuk saat modal ditutup
        $('#masuk').on('hidden.bs.modal', function() {
            resetCapture('masuk');
        });
        // Panggil fungsi resetPulang saat modal ditutup
        $('#pulang').on('hidden.bs.modal', function() {
            resetCapture('pulang');
        });

        // mengrim data ke server untuk di simpan ke database absensi masuk
        function submitAbsenMasuk() {

            const currentDate = new Date();
            const currentTime = (currentDate.getHours() < 10 ? "0" : "") + currentDate.getHours() +
                ":" + (currentDate.getMinutes() < 10 ? "0" : "") + currentDate.getMinutes();


            $.ajax({
                url: '/lokasi',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('data: ', data);
                    const masukStartTime = data.map(item => item
                        .jam_masuk); // Ganti dengan nama kolom yang sesuai di respons JSON
                    const masukEndTime = masukStartTime.map(startTime => {
                        const jamMasuk = new Date(
                            `01/01/2023 ${startTime}`
                        ); // Menggunakan tanggal sembarang, karena hanya peduli dengan jam
                        jamMasuk.setMinutes(jamMasuk.getMinutes() + 60); //09:00

                        // Mengubah format jam ke format yang sama dengan masukStartTime
                        const formattedEndTime = (jamMasuk.getHours() < 10 ? "0" : "") + jamMasuk
                            .getHours() +
                            ":" + (jamMasuk.getMinutes() < 10 ? "0" : "") + jamMasuk.getMinutes();

                        return formattedEndTime;
                    });

                    console.log("Current Time:", currentTime);
                    console.log("Masuk Start Time:", masukStartTime);

                    if (currentTime >= masukStartTime && currentTime <= masukEndTime) {

                        var formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');

                        var capturedImageInput = document.getElementById('captured-image-input-masuk');
                        formData.append('captured_image', capturedImageInput.value);

                        var latitude = document.getElementById('latitudeMasuk').textContent;
                        var longitude = document.getElementById('longitudeMasuk').textContent;
                        formData.append('latitude', latitude);
                        formData.append('longitude', longitude);

                        $.ajax({
                            url: '{{ route('karyawan.absensi.masuk') }}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,

                        }).done(function(response) {
                            console.log(response);
                            // location.reload();
                        }).fail(function(response) {
                            console.log(response);
                            // location.reload();
                        });

                        // Reset form
                        resetCapture('masuk');

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: `Absen masuk hanya dapat dilakukan antara jam ${masukStartTime} dan ${masukEndTime}.`,
                        });
                    }
                }
            });




        }

        // mengrim data ke server untuk di simpan ke database absensi pulang
        function submitAbsenPulang() {

            const currentTime = getCurrentTime();
            const pulangStartTime = 17 * 60; // 5:00 PM
            const pulangEndTime = 18 * 60 + 15; // 6:15 PM

            if (currentTime >= pulangStartTime && currentTime <= pulangEndTime) {

                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');

                var capturedImageInput = document.getElementById('captured-image-input-pulang');
                formData.append('captured_image', capturedImageInput.value);

                var latitude = document.getElementById('latitudePulang').textContent;
                var longitude = document.getElementById('longitudePulang').textContent;
                formData.append('latitude', latitude);
                formData.append('longitude', longitude);

                $.ajax({
                    url: '/karyawan/absensi-pulang',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                }).done(function(response) {
                    console.log(response);
                    location.reload();
                }).fail(function(response) {
                    console.log(response);
                    location.reload();
                });

                // Reset form
                resetCapture('pulang');

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Absen pulang hanya dapat dilakukan antara jam 17:00 dan 18:15.',
                });
            }



        }


        // map
        function getLocationMasuk() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPositionMasuk);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function getLocationPulang() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPositionPulang);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPositionMasuk(position) {
            var latitudeMasuk = position.coords.latitude;
            var longitudeMasuk = position.coords.longitude;
            console.log("Latitude: " + latitudeMasuk);
            console.log("Longitude: " + longitudeMasuk);
            document.getElementById('latitudeMasuk').innerHTML = latitudeMasuk;
            document.getElementById('longitudeMasuk').innerHTML = longitudeMasuk;
        }

        function showPositionPulang(position) {
            var latitudePulang = position.coords.latitude;
            var longitudePulang = position.coords.longitude;
            console.log("Latitude: " + latitudePulang);
            console.log("Longitude: " + longitudePulang);
            document.getElementById('latitudePulang').innerHTML = latitudePulang;
            document.getElementById('longitudePulang').innerHTML = longitudePulang;
        }
        getLocationMasuk();
        getLocationPulang();

        var map = L.map('map').setView([-7.2971498, 104.603765], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="#">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);


        $.ajax({
            url: '{{ route('lokasiKantor') }}',
            type: 'GET',
            success: function(data) {
                $.each(data, function(i, item) {
                    var marker = L.marker([item.latitude, item.longitude])
                        .bindPopup('Nama Kantor : ' + item.nama_kantor + '<br>' +
                            'Alamat Kantor :' + item.alamat_kantor).addTo(map);

                    var radius = L.circle([item.latitude, item.longitude], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5,
                        radius: 100
                    }).addTo(map);
                });
            }
        })
    </script>
@endsection
