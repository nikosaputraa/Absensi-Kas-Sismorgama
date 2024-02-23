@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Absensi'])
<div class="row mt-4 mx-3">
    <div class="col-12">
        @if(session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show text-white" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>{{ session('success') }}</strong></span>
            <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <script>
        // Membuat fungsi untuk menyembunyikan alert setelah 2 detik
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
        }, 2000);
        </script>
        @endif
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form">
                    <i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Sesi Absen</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama Kegiatan
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tanggal</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <?php 
                            use App\Models\Sesi;

                            $i = 1; 
                            $sesi = Sesi::all();
                        ?>
                        @foreach ($sesi as $item)
                        <tbody>
                            <tr>
                                <td class="align-middle text-center text-sm"><?= $i ?></td>
                                <td class="align-middle text-sm">
                                    <p class="text-sm font-weight-bold mb-0">{{ $item['judul'] }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-sm font-weight-bold mb-0">{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</p>
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="btn btn-info mt-2" href="{{ route('absen-scan', $item->id_sesi) }}" target="_blank"
                                            style="margin-right: 5px; font-size: 12px;"><i
                                                class="fa-solid fa-expand" style="margin-right: 5px;"></i> Scan</a>

                                        <a class="btn btn-success mt-2" href="{{ route('detail-absen', $item->id_sesi) }}"
                                            style="margin-right: 5px; font-size: 12px;"><i
                                                class="fa-solid fa-circle-info" style="margin-right: 5px;"></i> Details</a>
                                
                                        <a class="btn btn-danger mt-2" onclick="confirmDelete('{{ $item->id_sesi }}')"
                                            style="font-size: 12px;"><i class="fa-solid fa-trash" style="margin-right: 5px;"></i> Delete</a>
                                    </div>
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
</div>


<!-- modal -->
<div class="col-md-4">
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-info text-gradient text-center">Sesi Absensi</h3>
                            <p class="mb-0 text-center">Tambahkan sesi untuk melakukan absensi</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sesi-absensi') }}" method="post" role="form text-left">
                                {{ csrf_field() }}

                                <label>Tanggal</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="tanggal">
                                </div>
                                <label>Judul Kegiatan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="judul" placeholder="Masukkan judul kegiatan">
                                </div>
                                <label>Deskripsi Kegiatan</label>
                                <div class="input-group mb-1">
                                    <textarea name="nama_kegiatan" cols="30" rows="4" class="form-control"
                                        placeholder="Masukkan deskripsi kegiatan"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Tambah
                                        Sesi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
function confirmDelete(itemId) {
    var isConfirmed = confirm("Apakah anda yakin ingin menghapus data ini?");

    if (isConfirmed) {
        // Jika pengguna mengonfirmasi, arahkan ke URL delete dengan ID
        window.location.href = '/delete-sesi/' + itemId;
    } else {
        // Jika pengguna membatalkan, tidak lakukan apa-apa
    }
}
</script>
@endsection