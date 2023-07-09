@extends('layouts.app')

@section('style')
    <style>
        @media (max-width: 767px) {

            /* Ubah ukuran sesuai dengan ukuran layar mobile yang diinginkan */
            #webcam-pagi video {
                display: none;
            }
        }

        @media (min-width: 768px) {

            /* Ubah ukuran sesuai dengan ukuran layar desktop yang diinginkan */
            #webcam-pagi input {
                display: none;
            }

        }

        #imagePreviewPagi img {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
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
                            <p class="text-center">{{ $lat }}, {{ $lon }}</p>
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longtitude" id="longtitude">


                            <div id="webcam-pagi" class="d-flex justify-content-center">
                                <video id="video-pagi" width="100%" height="100%" autoplay playsinline></video>
                                <input type="file" accept="image/*" capture="camera" id="uploadInputPagi">
                                <br />
                                <div id="imagePreviewPagi"></div>
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
        document.getElementById('uploadInputPagi').addEventListener('change', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var imagePreview = document.getElementById('imagePreviewPagi');
                var img = document.createElement('img');
                img.onload = function() {
                    URL.revokeObjectURL(img.src); // Menghindari memory leak
                };
                img.src = e.target.result;
                imagePreview.innerHTML = '';
                imagePreview.appendChild(img);
            }

            reader.readAsDataURL(file);
        });
    </script>
@endsection
