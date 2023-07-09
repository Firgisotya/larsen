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
                            {{-- mendapatkan lokasi user dan mendapatkan latitude dan longtitude --}}
                            <div id="lokasi" class="d-flex justify-content-center">
                            </div>
                            <h3 class="text-center">Lokasi Anda</h3>
                            <p class="text-center"></p>
                            <input type="hidden" name="latitude" id="latitude" value="">
                            <input type="hidden" name="longtitude" id="longtitude" value="">


                            <div id="webcam-pagi" class="d-flex justify-content-center">
                                <video id="video-pagi" width="100%" height="100%" autoplay playsinline></video>
                                <div class="row">
                                    <img class="img-fluid mb-3 col-sm-5" id="imagePreviewPagi">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" capture="camera" id="uploadInputPagi"
                                            class="custom-file-input" onchange="previewImage()">
                                        <label class="custom-file-label" for="uploadInputPagi"></label>
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
                            <button type="button" class="btn btn-success">Absen</button>
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
                            <div id="webcam-siang" class="d-flex justify-content-center"></div>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-info" onclick="captureImage('siang')">Ambil
                                    Foto</button>
                                <button type="button" class="btn btn-info" onclick="captureImage('siang')">Ambil
                                    Foto</button>
                            </div>
                            <img id="captured-image-siang" src="" alt="Captured Image">
                            <input id="captured-image-input-siang" type="hidden" name="webcam-siang" value="">
                            <input type="hidden" name="waktu-siang" value="siang">
                            <div class="col-md-12 text-center">
                                <br />
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="webcam-sore" class="d-flex justify-content-center"></div>
                            <button type="button" onclick="captureImage('sore')">Ambil Foto</button>
                            <img id="captured-image-sore" src="" alt="Captured Image">
                            <input id="captured-image-input-sore" type="hidden" name="webcam-sore" value="">
                            <input type="hidden" name="waktu-sore" value="sore">
                            <div class="col-md-12 text-center">
                                <br />
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    {{-- map --}}
    {{-- <input type="hidden" name="latitude" id="latitude" value="{{ $lat }}"> --}}
    {{-- <input type="hidden" name="longtitude" id="longtitude" value="{{ $lon }}"> --}}
    <div id="map"></div>
@endsection

@section('script')
    <script>
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

            document.getElementById('video-pagi').style.display = 'none';
            document.getElementById('captured-image-pagi').src = dataURL;
            document.getElementById('captured-image-input-' + waktu).value = dataURL;
            document.getElementById('captured-image-pagi-container').style.display = 'block';
            document.getElementById('capture-pagi').style.display = 'none';
            document.getElementById('reset-pagi').style.display = 'inline-block';
        }

        // Fungsi untuk mereset foto
        function resetImage(waktu) {
            document.getElementById('video-pagi').style.display = 'block';
            document.getElementById('captured-image-pagi-container').style.display = 'none';
            document.getElementById('capture-pagi').style.display = 'inline-block';
            document.getElementById('reset-pagi').style.display = 'none';
            document.getElementById('captured-image-input-' + waktu).value = '';
        }

        // Panggil fungsi getCameraStream saat modal ditampilkan
        $('#pagi').on('shown.bs.modal', function() {
            getCameraStream('pagi');
        });

        // Panggil fungsi resetImage saat modal ditutup
        $('#pagi').on('hidden.bs.modal', function() {
            resetImage('pagi');
        });


        // preview image
        function previewImage() {
            var fileInput = document.getElementById('uploadInputPagi');
            var imagePreview = document.getElementById('imagePreviewPagi');

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
        // setInterval(() => {
        //     geoLocation();
        // }, 3000);

        // function geoLocation() {
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(showPosition);
        //     } else {
        //         alert("Geolocation is not supported by this browser.");
        //     }
        // }


        // function showPosition(position) {
        //     // console.log(position.coords.latitude, position.coords.longitude);
        //    latitude = document.getElementById('latitude').value = position.coords.latitude;
        //    longitude = document.getElementById('longtitude').value = position.coords.longitude;
        // }


        var map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan marker lokasi
        var locationMarker = L.marker([latitude, longitude]).addTo(map);

        // Tambahkan radius dengan jari-jari 500 meter
        var radius = L.circle([latitude, longitude], {
            color: 'blue',
            fillColor: 'lightblue',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);
    </script>
@endsection
