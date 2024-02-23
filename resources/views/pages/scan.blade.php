@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Absensi QR Code'])
<!-- Scan QR Code -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
</script>
<script type="text/javascript" src="{!! asset('assets/scan/instascan.min.js') !!}"></script>

<div class="row mt-4 mx-3">
    <div class="col-12">
        <div class="card card-profile">
            <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                <div class="justify-content-center">
                    <center>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div id="preview"
                                    style="position: relative; width: 100%; height: 0; padding-bottom: 75%;">
                                    <video style="position: absolute; top: 0; width: 100%; height: 100%;"></video>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="text" id="hasilscan" placeholder="hasil scan" class="form-control"
                                readonly>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
let scanner = new Instascan.Scanner({
    video: document.getElementById('preview').querySelector('video')
});

scanner.addListener('scan', function(content) {
    document.getElementById('hasilscan').value = content;
});

Instascan.Camera.getCameras().then(function(cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('No cameras found.');
    }
}).catch(function(e) {
    console.error(e);
});
</script>

@endsection