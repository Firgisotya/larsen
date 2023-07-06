@extends('layouts.app')

@section('content')
            <div class="row">
                <div class="col-4">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title text-primary d-flex justify-content-center">
                                <i class="fas fa-camera-alt fa-5x"></i>
                            </h5>
                            <h2 class="card-text text-primary d-flex justify-content-center">Absen Pagi</h2>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title text-primary d-flex justify-content-center">
                                <i class="fas fa-camera-alt fa-5x"></i>
                            </h5>
                            <h2 class="card-text text-primary d-flex justify-content-center">Absen Siang</h2>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title text-primary d-flex justify-content-center">
                                <i class="fas fa-camera-alt fa-5x"></i>
                            </h5>
                            <h2 class="card-text text-primary d-flex justify-content-center">Absen Sore</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <form method="POST" action="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div id="my_camera"></div>
                                <br/>
                                <input type=button value="Take Snapshot">
                                <input type="hidden" name="image" class="image-tag">
                            </div>
                            <div class="col-md-6">
                                <div id="results">Your captured image will appear here...</div>
                            </div>
                            <div class="col-md-12 text-center">
                                <br/>
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@section('script')
<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );

    // function take_snapshot() {
    //     Webcam.snap( function(data_uri) {
    //         $(".image-tag").val(data_uri);
    //         document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    //     } );
    // }
</script>
@endsection

@endsection
