@extends('layouts.app')

@section('style')
    <style>
        @media (max-width: 767px) {

            /* Ubah ukuran sesuai dengan ukuran layar mobile yang diinginkan */
            #webcam-masuk video {
                display: none;
            }

            #capture-masuk {
                display: none;
            }
        }

        @media (min-width: 768px) {

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
@endsection

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
                                <button type="button" class="btn btn-warning" onclick="getLocation()">Lokasi
                                    Anda</button>
                                <div class="d-flex justify-content-center gap-2">
                                    Latitude: <span id="latitude" name="latitude"></span>
                                    Longitude: <span id="longitude" name="longitude"></span>
                                </div>
                            </div>

                            <div id="webcam-masuk" class="d-flex justify-content-center">
                                <video id="video-masuk" width="100%" height="100%" autoplay playsinline></video>
                                <div class="row">
                                    <img class="img-fluid mb-3 col-sm-5" id="imagePreview-masuk">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" capture="camera" id="uploadInput-masuk"
                                            class="custom-file-input" onchange="previewImage('masuk')">
                                        <label class="custom-file-label" for="uploadInput-masuk"></label>
                                    </div>
                                </div>
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
                            <button type="button" class="btn btn-success" onclick="submitAbsen('masuk')"
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

                            <div id="webcam-pulang" class="d-flex justify-content-center">
                                <video id="video-pulang" width="100%" height="100%" autoplay playsinline></video>
                                <div class="row">
                                    <img class="img-fluid mb-3 col-sm-5" id="imagePreview-pulang">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" capture="camera" id="uploadInput-pulang"
                                            class="custom-file-input" onchange="previewImage('pulang')">
                                        <label class="custom-file-label" for="uploadInput-pulang"></label>
                                    </div>
                                </div>
                            </div>
                            <div id="captured-image-pulang-container" style="display: none;">
                                <img id="captured-image-pulang" width="100%" height="100%" src=""
                                    alt="Captured Image">
                            </div>
                            <input id="captured-image-input-pulang" type="hidden" name="webcam-pulang" value="">
                            <input type="hidden" name="waktu-pulang" value="pulang">
                            <div class="col-md-12 text-center">
                                <br />
                                <button id="capture-pulang" class="btn btn-primary" onclick="captureImage('pulang')">Ambil
                                    Foto</button>
                                <button id="reset-pulang" class="btn btn-danger" style="display: none;"
                                    onclick="resetImage('pulang')">Reset</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="submitAbsen('pulang')"
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
        var modalBodyMasuk = document.querySelector("#masuk .modal-body");
        var modalBodyPulang = document.querySelector("#pulang .modal-body");

        // Mendapatkan elemen video dan tombol ambil foto
        var videoMasuk = document.getElementById("video-masuk");
        var captureButtonMasuk = document.getElementById("capture-masuk");
        var videoPulang = document.getElementById("video-pulang");
        var captureButtonPulang = document.getElementById("capture-pulang");

        // Mendapatkan waktu saat ini
        var currentTime = new Date();
        var currentHour = currentTime.getHours();

        // Memeriksa jika waktu lebih dari jam 10
        if (currentHour >= 24) {
            // Mengubah isi modal body menjadi teks waktu absen masuk habis
            modalBodyMasuk.innerHTML = "<h4>Waktu absen masuk sudah habis.</h4>";
            modalBodyPulang.innerHTML = "<h4>Waktu absen pulang sudah habis.</h4>";

            // Menonaktifkan video dan tombol ambil foto
            videoMasuk.style.display = "none";
            captureButtonMasuk.disabled = true;
            videoPulang.style.display = "none";
            captureButtonPulang.disabled = true;
        } else if (currentHour >= 24) {
            // Mengubah isi modal body menjadi teks waktu absen masuk habis
            modalBodyMasuk.innerHTML = "<h4>Waktu absen masuk sudah habis.</h4>";

            // Menonaktifkan video dan tombol ambil foto
            videoMasuk.style.display = "none";
            captureButtonMasuk.disabled = true;
        } else if (currentHour >= 24) {
            // Mengubah isi modal body menjadi teks waktu absen masuk habis
            modalBodyMasuk.innerHTML = "<h4>Waktu absen masuk sudah habis.</h4>";

            // Menonaktifkan video dan tombol ambil foto
            videoMasuk.style.display = "none";
            captureButtonMasuk.disabled = true;
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
            console.log(waktu);

            // Kirim data ke server
            // var xhr = new XMLHttpRequest();
            // xhr.open('POST', '{{ route('karyawan.absensi.store') }}', true);
            // xhr.onreadystatechange = function() {
            //     if (xhr.readyState === 4) {
            //         if (xhr.status === 200) {
            //             console.log('Absensi saved successfully');
            //             // Tambahkan logika yang sesuai setelah absensi berhasil disimpan
            //             location.reload();
            //         } else if (xhr.status === 400) {
            //             console.log('Error: ' + xhr.status);
            //             // Tambahkan logika untuk menangani pesan kesalahan
            //             var response = JSON.parse(xhr.responseText);
            //             console.log(response.message);
            //             location.reload();
            //         }
            //     }
            // };
            // xhr.send(formData);

            $.ajax({
                url: '{{ route('karyawan.absensi.store') }}',
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
