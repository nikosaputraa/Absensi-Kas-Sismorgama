@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Daftar Anggota'])
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
                <a href="{{ route('tambah-anggota') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus" style="margin-right: 5px;"></i> Tambah Anggota</a>
                <a href="{{ route('generate-qr') }}" class="btn btn-success">
                    <i class="fa-solid fa-qrcode" style="margin-right: 5px;"></i> Generate All QR-Code</a>
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
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    NIM
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Jenis Kelamin</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Divisi</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No HP</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <?php 
                        use App\Models\Anggota;

                        $i = 1; 
                        // $anggota = Anggota::latest()->paginate(5);
                        $anggota = Anggota::all();

                        ?>
                        @foreach ($anggota as $item)
                        <tbody>
                            <tr>
                                <td td class="align-middle text-center text-sm"><?= $i ?></td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$item['nis']}}</p>
                                </td>
                                <td class="align-middle text-sm">
                                    <p class="text-sm font-weight-bold mb-0">{{$item['nama_siswa']}}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-sm font-weight-bold mb-0">{{$item['jenis_kelamin']}}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-sm font-weight-bold mb-0">
                                        @if($item['id_kelas'] == 1)
                                        Divisi Humas
                                        @elseif($item['id_kelas'] == 2)
                                        Divisi Acara
                                        @elseif($item['id_kelas'] == 3)
                                        Divisi Kominfo
                                        @else
                                        Divisi Lainnya
                                        @endif
                                    </p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-sm font-weight-bold mb-0">{{$item['no_hp']}}</p>
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a class="btn btn-info mt-2" href="{{ route('edit-anggota', $item->id_siswa) }}"
                                            style="margin-right: 5px; font-size: 12px;"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-danger mt-2" onclick="confirmDelete('{{ $item->id_siswa }}')"
                                            style="font-size: 12px;"><i class="fa-solid fa-trash"></i></a>
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

<script>
function confirmDelete(itemId) {
    var isConfirmed = confirm("Apakah anda yakin ingin menghapus data ini?");

    if (isConfirmed) {
        // Jika pengguna mengonfirmasi, arahkan ke URL delete dengan ID
        window.location.href = '/delete-anggota/' + itemId;
    } else {
        // Jika pengguna membatalkan, tidak lakukan apa-apa
    }
}
</script>
@endsection