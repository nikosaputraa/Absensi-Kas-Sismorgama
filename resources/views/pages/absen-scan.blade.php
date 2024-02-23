<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        Sismorgama - Scan QR-Code
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{!! asset('assets/css/nucleo-icons.css') !!}" rel="stylesheet" />
    <link href="{!! asset('assets/css/nucleo-svg.css') !!}" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="{!! asset('assets/css/argon-dashboard.css') !!}" rel="stylesheet" />

    <!-- ICON -->
    <script src="https://kit.fontawesome.com/588acb177c.js" crossorigin="anonymous"></script>

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

    <style>
    body {
        display: flex;
        justify-content: space-between;
        align-items: stretch;
        height: 100vh;
        margin: 0;
    }
    </style>
</head>

<body>
    <div class="min-height-300 bg-primary position-absolute w-100"
        style="background-image: url({!! asset('assets/img/amikom.jpg') !!}); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>
    <div class="row mt-4 col-12">
        <div class="col-lg-6 mb-2" style="margin-left: 15px;">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h3 class="mb-0 text-center">Absensi</h3>
                    <p class="text-sm text-center" id="realtimeDateTime">
                        {{ \Carbon\Carbon::parse($data['tanggal'])->format('d-m-Y') }}
                    </p>
                    <p class="text-center" style="margin-top: -5px;">Silahkan Scan QR-Code Anda!</p>
                </div>
                <div class="card-body" style="margin-top: -55px;">
                    <div id="preview" style="position: relative; width: 100%; height: 0; padding-bottom: 75%;">
                        <video style="position: absolute; top: 0; width: 100%; height: 100%;"></video>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-6" style="margin-left: -10px; margin-right: -5px;">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h3 class="mb-0 text-center">Data Absensi</h3>
                    <p class="text-sm text-center">{{ $data->judul }}</p>
                </div>
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="dataAbsensiContainer">
                        <thead>
                            <tr>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    NIM
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nama Mahasiswa
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Divisi</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Waktu Absen</th>
                            </tr>
                        </thead>
                        <?php 
                            $i = 1; 
                        ?>
                        @foreach ($dataPresensi as $presensi)
                        <tbody>
                            <tr>
                                <td td class="align-middle text-center text-sm"><?= $i ?></td>
                                <td>
                                    <p class="text-sm mb-0">{{ $presensi->nim }}</p>
                                </td>
                                <td>
                                    <p class="text-sm mb-0">{{ $presensi->nama_mahasiswa }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-sm mb-0">
                                        @if($presensi['divisi'] == 1)
                                        Divisi Humas
                                        @elseif($presensi['divisi'] == 2)
                                        Divisi Acara
                                        @elseif($presensi['divisi'] == 3)
                                        Divisi Kominfo
                                        @else
                                        Divisi Lainnya
                                        @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-sm mb-0">
                                        {{ $presensi->waktu_absen }}</p>
                                </td>
                            </tr>
                        </tbody>
                        <?php $i++; ?>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{!! asset('assets/js/core/popper.min.js') !!}"></script>
    <script src="{!! asset('assets/js/core/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('assets/js/plugins/perfect-scrollbar.min.js') !!}"></script>
    <script src="{!! asset('assets/js/plugins/smooth-scrollbar.min.js') !!}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
    </script>
    <script type="text/javascript" src="{!! asset('assets/scan/instascan.min.js') !!}"></script>

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview').querySelector('video')
    });

    scanner.addListener('scan', function(content) {
        // Kirim hasil scan ke server
        fetch('{{ route('process-presensi', $data->id_sesi) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        unique_code: content
                    })
                })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Jika cocok, tampilkan SweetAlert presensi berhasil
                    Swal.fire({
                        icon: 'success',
                        title: 'Presensi Berhasil!',
                        text: 'Presensi anda telah direkam',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    // Setelah 1 detik, refresh data absensi saja
                    setTimeout(() => {
                        fetchDataAbsensi();
                    }, 1000);
                } else {
                    // Jika tidak cocok, tampilkan SweetAlert presensi tidak berhasil
                    Swal.fire({
                        icon: 'error',
                        title: 'Presensi Gagal!',
                        text: 'QR Code tidak valid',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            })
            .catch(error => console.error('Error:', error));
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

    // Auto refresh data absensi setiap 2 detik
    setInterval(function() {
        fetchDataAbsensi();
    }, 2000);

    // Fungsi untuk mengambil data absensi dari server dan memperbarui container
    function fetchDataAbsensi() {
        fetch('{{ route('update-absen-scan', $data->id_sesi) }}')
            .then(response => response.text())
            .then(html => {
                document.getElementById('dataAbsensiContainer').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
    <script>
        function updateRealtimeDateTime() {
            var now = new Date();
            var formattedDateTime = now.toLocaleString('en-US', { day: 'numeric', month: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false });
            document.getElementById('realtimeDateTime').innerText = formattedDateTime;
        }

        // Pemanggilan pertama kali
        updateRealtimeDateTime();

        // Set interval untuk memperbarui setiap detik
        setInterval(updateRealtimeDateTime, 1000);
    </script>

</body>

</html>