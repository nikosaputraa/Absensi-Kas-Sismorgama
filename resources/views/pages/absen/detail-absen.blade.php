@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Detail - Absensi'])
<div class="row mt-4 mx-3">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 mb-0">
                <a href="javascript:history.back()" class="btn btn-success">
                    <i class="fa-solid fa-angle-left"></i></a>
            </div>
            <div style="margin-top: -20px;">
                <h3 class="mb-0 text-center">Detail Absensi</h3>
                <p class="text-sm text-center">{{ $data->judul }}</p>
            </div>
            <div class="table-responsive p-0 mb-4">
                <table class="table align-items-center mb-0" id="dataAbsensiContainer">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Divisi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                    <input type="text" class="form-control" name="judul"
                                        placeholder="Masukkan judul kegiatan">
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

@endsection