@extends('layouts.app')

{{-- @section('style')
    <style>
        .circle {
            height: 50px;
            width: 50px;
            background-color: #555;
            border-radius: 50%;
        }

        @media (max-width: 700px) {

            /* Ubah ukuran sesuai dengan ukuran layar mobile yang diinginkan */
            #webcam-masuk video {
                display: none;
            }

            #capture-masuk {
                display: none;
            }

            #webcam-pulang video {
                display: none;
            }

            #capture-pulang {
                display: none;
            }
        }

        @media (min-width: 700px) {

            /* Ubah ukuran sesuai dengan ukuran layar desktop yang diinginkan */
            #webcam-masuk input {
                display: none;
            }

            .custom-file-input {
                display: none;
            }

            .custom-file-label {
                display: none;
            }

            #imagePreviewMasuk {
                display: none;
            }

        }


        /* Tombol Pilih Gambar */
        .custom-file-input {
            display: none;
        }

        .custom-file-label {
            background-color: #e9ecef;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        /* Gaya tambahan untuk elemen label */
        .custom-file-label::after {
            content: "Ambil Foto";
        }

        /* Gaya tambahan saat input memiliki file yang dipilih */
        .custom-file-input.has-file-selected~.custom-file-label::after {
            content: attr(data-file-name);
        }

        /* Gaya tambahan saat input memiliki file yang dipilih */
        .custom-file-input.has-file-selected~.custom-file-label {
            border-color: #e9ecef;
            background-color: #e9ecef;
        }

        #map {
            height: 400px;
        }
    </style>
@endsection --}}

@section('content')
    {{-- absen --}}
    <div class="row">

        {{-- masuk --}}
        <div class="col-6">
            <!-- Button trigger modal -->
            <div data-bs-toggle="modal" data-bs-target="#masuk">
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
                                    Latitude: <span id="latitude" name="latitude"></span>
                                    Longitude: <span id="longitude" name="longitude"></span>
                                </div>
                            </div>

                            <div id="webcam-masuk" class="d-flex justify-content-center">
                                <video class="d-sm-none" id="video-masuk" width="100%" height="100%" autoplay
                                    playsinline></video>
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
                                <button id="capture-masuk" class="btn btn-primary" onclick="captureImage('masuk')">Ambil
                                    Foto</button>
                                <button id="reset-masuk" class="btn btn-danger" style="display: none;"
                                    onclick="resetImage('masuk')">Reset</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn-masuk" onclick="submitAbsen('masuk')"
                                data-bs-dismiss="modal">Absen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- pulang --}}
        <div class="col-6">
            <!-- Button trigger modal -->
            <div data-bs-toggle="modal" data-bs-target="#pulang">
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div id="lokasi" class="d-flex flex-column justify-content-center mb-4">
                                <h3 class="text-center">Lokasi Anda</h3>
                                <div class="d-flex justify-content-center gap-2">
                                    Latitude: <span id="latitude" name="latitude"></span>
                                    Longitude: <span id="longitude" name="longitude"></span>
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
                                <button id="capture-pulang" class="btn btn-primary"
                                    onclick="captureImage('pulang')">Ambil
                                    Foto</button>
                                <button id="reset-pulang" class="btn btn-danger" style="display: none;"
                                    onclick="resetImage('pulang')">Reset</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn-pulang"
                                onclick="submitAbsen('pulang')" data-bs-dismiss="modal">Absen</button>
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

        // Mendapatkan waktu saat ini
        var currentTime = new Date();
        var currentHour = currentTime.getHours();

        // cek absensi menggunakan ajax

        $.ajax({
            url: '{{ route('karyawan.absensi.checkAbsen') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
            }
        });


        // Memeriksa jika waktu lebih dari jam 10
        if (currentHour >= 18) {
            // Mengubah isi modal body menjadi teks waktu absen masuk habis
            modalBodyMasuk.innerHTML = "<h4>Waktu absen masuk sudah habis.</h4>";
            modalBodyPulang.innerHTML = "<h4>Waktu absen pulang sudah habis.</h4>";

            // Menonaktifkan video dan tombol ambil foto
            videoMasuk.style.display = "none";
            captureButtonMasuk.disabled = true;
            videoPulang.style.display = "none";
            captureButtonPulang.disabled = true;
            btnMasuk.disabled = true;
            btnPulang.disabled = true;
        } else if (currentHour >= 10) {
            // Mengubah isi modal body menjadi teks waktu absen masuk habis
            modalBodyMasuk.innerHTML = "<h4>Waktu absen masuk sudah habis.</h4>";

            // Menonaktifkan video dan tombol ambil foto
            videoMasuk.style.display = "none";
            captureButtonMasuk.disabled = true;
            btnMasuk.disabled = true;
        }


        // Fungsi untuk mengambil akses ke kamera
        function getCameraStream(waktu) {
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
        function captureImage(waktu) {
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
        function resetImage(waktu) {
            document.getElementById('video-' + waktu).style.display = 'block';
            document.getElementById('captured-image-' + waktu + '-container').style.display = 'none';
            document.getElementById('capture-' + waktu).style.display = 'inline-block';
            document.getElementById('reset-' + waktu).style.display = 'none';
            document.getElementById('captured-image-input-' + waktu).value = '';
        }

        // Panggil fungsi getCameraStream saat modal ditampilkan
        $('#masuk').on('shown.bs.modal', function() {
            getCameraStream('masuk');
        });
        $('#pulang').on('shown.bs.modal', function() {
            getCameraStream('pulang');
        });

        // Panggil fungsi resetImage saat modal ditutup
        $('#masuk').on('hidden.bs.modal', function() {
            resetImage('masuk');
        });
        $('#pulang').on('hidden.bs.modal', function() {
            resetImage('pulang');
        });

        // mengrim data ke server untuk di simpan
        function submitAbsen(waktu) {


            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');

            var capturedImageInput = document.getElementById('captured-image-input-' + waktu);
            formData.append('captured_image', capturedImageInput.value);

            var latitude = document.getElementById('latitude').textContent;
            var longitude = document.getElementById('longitude').textContent;
            formData.append('latitude', latitude);
            formData.append('longitude', longitude);

            formData.append('waktu', waktu); // Ganti dengan waktu yang sesuai


            $.ajax({
                url: '/karyawan/absensi-' + waktu,
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
            resetImage(waktu);
        }



        // preview image
        function previewImage(waktu) {
            var fileInput = document.getElementById('uploadInput-' + waktu);
            var imagePreview = document.getElementById('imagePreview-' + waktu);

            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.onload = function() {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');

                    // Mengatur ukuran canvas sesuai dengan orientasi gambar
                    if (img.width > img.height) {
                        canvas.width = 400;
                        canvas.height = 300;
                    } else {
                        canvas.width = 300;
                        canvas.height = 400;
                    }

                    // Memperbaiki orientasi gambar jika diperlukan
                    if (window.innerWidth < window.innerHeight) {
                        if (img.width > img.height) {
                            ctx.translate(canvas.width / 2, canvas.height / 2);
                            ctx.rotate(90 * Math.PI / 180);
                            ctx.drawImage(img, -canvas.height / 2, -canvas.width / 2, canvas.height, canvas.width);
                        } else {
                            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        }
                    } else {
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    }

                    // Mengubah gambar menjadi tautan data dan menampilkannya
                    var dataURL = canvas.toDataURL('image/jpeg');
                    imagePreview.src = dataURL;
                };

                img.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }

        // map
        function getLocation(waktu) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            console.log("Latitude: " + latitude);
            console.log("Longitude: " + longitude);
            document.getElementById('latitude').innerHTML = latitude;
            document.getElementById('longitude').innerHTML = longitude;
        }
        getLocation();

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
