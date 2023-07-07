@extends('layouts.app')

@section('content')
    <div class="row">
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
                            <form method="POST" action="">
                                @csrf
                                        <div id="my_camera"></div>
                                        <br />
                                        <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                        <input type="hidden" name="image" class="image-tag">
                                    
                                    <div class="col">
                                        <div id="results">Your captured image will appear here...</div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <br />
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
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
                            <form method="POST" action="">
                                @csrf
                                        <div id="my_camera"></div>
                                        <br />
                                        <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                        <input type="hidden" name="image" class="image-tag">
                                    
                                    <div class="col">
                                        <div id="results">Your captured image will appear here...</div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <br />
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
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
                            <form method="POST" action="">
                                @csrf
                                        <div id="my_camera"></div>
                                        <br />
                                        <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                        <input type="hidden" name="image" class="image-tag">
                                    
                                    <div class="col">
                                        <div id="results">Your captured image will appear here...</div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <br />
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                            </form>
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

   

@section('script')
    <script>
        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#pagi');
        Webcam.attach('#siang');
        Webcam.attach('#sore');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>
@endsection
@endsection
