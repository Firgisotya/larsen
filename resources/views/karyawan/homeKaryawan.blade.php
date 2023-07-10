@extends('layouts.app')

@section('style')
    <style>
        @media (max-width: 767px) {

            /* Ubah ukuran sesuai dengan ukuran layar mobile yang diinginkan */
            #webcam-pagi video {
                display: none;
            }

            #capture-pagi {
                display: none;
            }
        }

        @media (min-width: 768px) {

            /* Ubah ukuran sesuai dengan ukuran layar desktop yang diinginkan */
            #webcam-pagi input {
                display: none;
            }

            .custom-file-input {
                display: none;
            }

            .custom-file-label {
                display: none;
            }

            #imagePreviewPagi {
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
@endsection

@section('content')
    {{-- absen --}}
    <div class="row">

        {{-- pagi --}}
        <div class="col-4">
            <!-- Button trigger modal -->
            <div data-bs-toggle="modal" data-bs-target="#pagi">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title text-primary d-flex justify-content-center">
                            <i class="fas fa-camera-alt fa-5x"></i>
                        </h5>
                        <h2 class="card-text text-primary d-flex justify-content-center">Absen Pagi</h2>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="pagi" tabindex="-1" aria-labelledby="pagiLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Absen Pagi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div id="lokasi" class="d-flex flex-column justify-content-center mb-4">
                                <h3 class="text-center">Lokasi Anda</h3>
                                <button type="button" class="btn btn-warning" onclick="getLocation()">Lokasi
                                    Anda</button>
                                <div class="d-flex justify-content-center gap-2">
                                    Latitude: <span id="latitude" name="latitude"></span>
                                    Longitude: <span id="longitude" name="longitude"></span>
                                </div>
                            </div>

                            <div id="webcam-pagi" class="d-flex justify-content-center">
                                <video id="video-pagi" width="100%" height="100%" autoplay playsinline></video>
                                <div class="row">
                                    <img class="img-fluid mb-3 col-sm-5" id="imagePreview-pagi">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" capture="camera" id="uploadInput-pagi"
                                            class="custom-file-input" onchange="previewImage()">
                                        <label class="custom-file-label" for="uploadInput-pagi"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="captured-image-pagi-container" style="display: none;">
                                <img id="captured-image-pagi" width="100%" height="100%" src=""
                                    alt="Captured Image">
                            </div>
                            <input id="captured-image-input-pagi" type="hidden" name="webcam-pagi" value="">
                            <input type="hidden" name="waktu-pagi" value="pagi">
                            <div class="col-md-12 text-center">
                                <br />
                                <button id="capture-pagi" class="btn btn-primary" onclick="captureImage('pagi')">Ambil
                                    Foto</button>
                                <button id="reset-pagi" class="btn btn-danger" style="display: none;"
                                    onclick="resetImage('pagi')">Reset</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="submitAbsen('pagi')"
                                data-bs-dismiss="modal">Absen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- siang --}}
        <div class="col-4">
            <!-- Button trigger modal -->
            <div data-bs-toggle="modal" data-bs-target="#siang">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title text-primary d-flex justify-content-center">
                            <i class="fas fa-camera-alt fa-5x"></i>
                        </h5>
                        <h2 class="card-text text-primary d-flex justify-content-center">Absen Siang</h2>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="siang" tabindex="-1" aria-labelledby="siangLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Absen Siang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div id="lokasi" class="d-flex flex-column justify-content-center mb-4">
                                <h3 class="text-center">Lokasi Anda</h3>
                                <button type="button" class="btn btn-warning" onclick="getLocation()">Lokasi
                                    Anda</button>
                                <div class="d-flex justify-content-center gap-2">
                                    Latitude: <span id="latitude" name="latitude"></span>
                                    Longitude: <span id="longitude" name="longitude"></span>
                                </div>
                            </div>

                            <div id="webcam-siang" class="d-flex justify-content-center">
                                <video id="video-siang" width="100%" height="100%" autoplay playsinline></video>
                                <div class="row">
                                    <img class="img-fluid mb-3 col-sm-5" id="imagePreview-siang">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" capture="camera" id="uploadInput-siang"
                                            class="custom-file-input" onchange="previewImage()">
                                        <label class="custom-file-label" for="uploadInput-siang"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="captured-image-siang-container" style="display: none;">
                                <img id="captured-image-siang" width="100%" height="100%" src=""
                                    alt="Captured Image">
                            </div>
                            <input id="captured-image-input-siang" type="hidden" name="webcam-siang" value="">
                            <input type="hidden" name="waktu-siang" value="siang">
                            <div class="col-md-12 text-center">
                                <br />
                                <button id="capture-siang" class="btn btn-primary" onclick="captureImage('siang')">Ambil
                                    Foto</button>
                                <button id="reset-siang" class="btn btn-danger" style="display: none;"
                                    onclick="resetImage('siang')">Reset</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="submitAbsen('siang')"
                                data-bs-dismiss="modal">Absen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- sore --}}
        <div class="col-4">
            <!-- Button trigger modal -->
            <div data-bs-toggle="modal" data-bs-target="#sore">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title text-primary d-flex justify-content-center">
                            <i class="fas fa-camera-alt fa-5x"></i>
                        </h5>
                        <h2 class="card-text text-primary d-flex justify-content-center">Absen Sore</h2>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="sore" tabindex="-1" aria-labelledby="soreLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Absen Sore</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div id="lokasi" class="d-flex flex-column justify-content-center mb-4">
                                <h3 class="text-center">Lokasi Anda</h3>
                                <button type="button" class="btn btn-warning" onclick="getLocation()">Lokasi
                                    Anda</button>
                                <div class="d-flex justify-content-center gap-2">
                                    Latitude: <span id="latitude" name="latitude"></span>
                                    Longitude: <span id="longitude" name="longitude"></span>
                                </div>
                            </div>

                            <div id="webcam-sore" class="d-flex justify-content-center">
                                <video id="video-sore" width="100%" height="100%" autoplay playsinline></video>
                                <div class="row">
                                    <img class="img-fluid mb-3 col-sm-5" id="imagePreview-sore">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" capture="camera" id="uploadInput-sore"
                                            class="custom-file-input" onchange="previewImage()">
                                        <label class="custom-file-label" for="uploadInput-sore"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="captured-image-sore-container" style="display: none;">
                                <img id="captured-image-sore" width="100%" height="100%" src=""
                                    alt="Captured Image">
                            </div>
                            <input id="captured-image-input-sore" type="hidden" name="webcam-sore" value="">
                            <input type="hidden" name="waktu-sore" value="sore">
                            <div class="col-md-12 text-center">
                                <br />
                                <button id="capture-sore" class="btn btn-primary" onclick="captureImage('sore')">Ambil
                                    Foto</button>
                                <button id="reset-sore" class="btn btn-danger" style="display: none;"
                                    onclick="resetImage('sore')">Reset</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="submitAbsen('sore')"
                                data-bs-dismiss="modal">Absen</button>
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
        var modalBodyPagi = document.querySelector("#pagi .modal-body");
        var modalBodySiang = document.querySelector("#siang .modal-body");
        var modalBodySore = document.querySelector("#sore .modal-body");

        // Mendapatkan elemen video dan tombol ambil foto
        var videoPagi = document.getElementById("video-pagi");
        var captureButtonPagi = document.getElementById("capture-pagi");
        var videoSiang = document.getElementById("video-siang");
        var captureButtonSiang = document.getElementById("capture-siang");
        var videoSore = document.getElementById("video-sore");
        var captureButtonSore = document.getElementById("capture-sore");

        // Mendapatkan waktu saat ini
        var currentTime = new Date();
        var currentHour = currentTime.getHours();

        // Memeriksa jika waktu lebih dari jam 10
        if (currentHour >= 18) {
            // Mengubah isi modal body menjadi teks waktu absen pagi habis
            modalBodyPagi.innerHTML = "<h4>Waktu absen pagi sudah habis.</h4>";
            modalBodySiang.innerHTML = "<h4>Waktu absen siang sudah habis.</h4>";
            modalBodySore.innerHTML = "<h4>Waktu absen sore sudah habis.</h4>";

            // Menonaktifkan video dan tombol ambil foto
            videoPagi.style.display = "none";
            captureButtonPagi.disabled = true;
            videoSiang.style.display = "none";
            captureButtonSiang.disabled = true;
            videoSore.style.display = "none";
            captureButtonSore.disabled = true;
        } else if (currentHour >= 14) {
            // Mengubah isi modal body menjadi teks waktu absen pagi habis
            modalBodyPagi.innerHTML = "<h4>Waktu absen pagi sudah habis.</h4>";
            modalBodySiang.innerHTML = "<h4>Waktu absen siang sudah habis.</h4>";

            // Menonaktifkan video dan tombol ambil foto
            videoPagi.style.display = "none";
            captureButtonPagi.disabled = true;
            videoSiang.style.display = "none";
            captureButtonSiang.disabled = true;
        } else if (currentHour >= 10) {
            // Mengubah isi modal body menjadi teks waktu absen pagi habis
            modalBodyPagi.innerHTML = "<h4>Waktu absen pagi sudah habis.</h4>";

            // Menonaktifkan video dan tombol ambil foto
            videoPagi.style.display = "none";
            captureButtonPagi.disabled = true;
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
            document.getElementById('captured-image-'+ waktu +'-container').style.display = 'block';
            document.getElementById('capture-' + waktu).style.display = 'none';
            document.getElementById('reset-' + waktu).style.display = 'inline-block';
        }

        // Fungsi untuk mereset foto
        function resetImage(waktu) {
            document.getElementById('video-' + waktu).style.display = 'block';
            document.getElementById('captured-image-'+ waktu +'-container').style.display = 'none';
            document.getElementById('capture-' + waktu).style.display = 'inline-block';
            document.getElementById('reset-' + waktu).style.display = 'none';
            document.getElementById('captured-image-input-' + waktu).value = '';
        }

        // Panggil fungsi getCameraStream saat modal ditampilkan
        $('#pagi').on('shown.bs.modal', function() {
            getCameraStream('pagi');
        });
        $('#siang').on('shown.bs.modal', function() {
            getCameraStream('siang');
        });
        $('#sore').on('shown.bs.modal', function() {
            getCameraStream('sore');
        });

        // Panggil fungsi resetImage saat modal ditutup
        $('#pagi').on('hidden.bs.modal', function() {
            resetImage('pagi');
        });
        $('#siang').on('hidden.bs.modal', function() {
            resetImage('siang');
        });
        $('#sore').on('hidden.bs.modal', function() {
            resetImage('sore');
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

            // Kirim data ke server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('karyawan.absensi.store') }}', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log('Absensi saved successfully');
                        // Tambahkan logika yang sesuai setelah absensi berhasil disimpan
                        location.reload();
                    } else if (xhr.status === 400) {
                        console.log('Error: ' + xhr.status);
                        // Tambahkan logika untuk menangani pesan kesalahan
                        var response = JSON.parse(xhr.responseText);
                        console.log(response.message);
                        location.reload();
                    }
                }
            };
            xhr.send(formData);
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
        function getLocation() {
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

        var map = L.map('map').setView([-7.8713039, 112.5245536], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan marker lokasi
        var locationMarker = L.marker([-7.8713039, 112.5245536]).addTo(map);

        // Tambahkan radius dengan jari-jari 500 meter
        var radius = L.circle([-7.8713039, 112.5245536], {
            color: 'blue',
            fillColor: 'lightblue',
            fillOpacity: 0.5,
            radius: 100
        }).addTo(map);
    </script>
@endsection
