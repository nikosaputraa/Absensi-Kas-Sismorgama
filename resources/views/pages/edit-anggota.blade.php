@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Edit Data Anggota'])

<div class="row mt-4 mx-3 mb-4">
    <div class="col-12">
        <div class="card card-profile">
            <div class="card-header pb-0">
                <a href="javascript:history.back()" class="btn btn-success">
                    <i class="fa-solid fa-angle-left"></i></a>
            </div>
            <div class="card-header border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                <form action="/update-anggota/{{ $data->id_siswa }}" method="post" role="form">
                    {{ csrf_field() }}
                    <!-- EMAIL -->
                    <div class="form-group col-md-12 justify-content-center">
                        <div class="mb-3">
                            <label for="inputNIS" class="form-label" style=" font-size: 14px;">NIM Mahasiswa</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Masukkan NIM"
                                aria-label="NIM" name="nis" value="{{ $data->nis }}">
                        </div>
                        <div class="mb-3">
                            <label for="inputNama" class="form-label" style=" font-size: 14px;">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Masukkan nama lengkap"
                                aria-label="Nama" name="nama_siswa" value="{{ $data->nama_siswa }}">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="inputDivisi" class="form-label" style=" font-size: 14px;">Divisi</label>
                                <select id="kelas" name="id_kelas" class="form-control form-control-lg">
                                    <option hidden selected value="{{ $data->id_kelas }}">@if($data['id_kelas'] == 1)
                                        Divisi Humas
                                        @elseif($data['id_kelas'] == 2)
                                        Divisi Acara
                                        @elseif($data['id_kelas'] == 3)
                                        Divisi Kominfo
                                        @else
                                        Divisi Lainnya
                                        @endif
                                    </option>
                                    <option value="1">Divisi Humas</option>
                                    <option value="2">Divisi Acara</option>
                                    <option value="3">Divisi Kominfo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputJenisKelamin" class="form-label" style=" font-size: 14px;">Jenis
                                    Kelamin</label>
                                <?php
                                    $jenisKelamin = (old('jk') ?? $oldInput['jk'] ?? $data['jenis_kelamin']);
                                    $l = $jenisKelamin == 'Laki-laki' || $jenisKelamin == '1' ? 'checked' : '';
                                    $p = $jenisKelamin == 'Perempuan' || $jenisKelamin == '2' ? 'checked' : '';
                                ?>
                                <div class="pt-0" id="jk">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="row">
                                                <div class="col-auto pt-2">
                                                    <input class="form-check" type="radio" name="jenis_kelamin"
                                                        id="laki" value="1" <?= $l ?? ''; ?>>
                                                </div>
                                                <div class="col pt-2" style="margin-left: -10px;">
                                                    <label class="form-check-label" for="laki">
                                                        <h6 class="text-dark">Laki-laki</h6>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-auto pt-2">
                                                    <input class="form-check" type="radio" name="jenis_kelamin"
                                                        id="perempuan" value="2" <?= $p ?? ''; ?>>
                                                </div>
                                                <div class="col pt-2" style="margin-left: -10px;">
                                                    <label class="form-check-label" for="perempuan">
                                                        <h6 class="text-dark">Perempuan</h6>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="inputNama" class="form-label" style=" font-size: 14px;">No Hp</label>
                            <input type="text" class="form-control form-control-lg" placeholder="+62" aria-label="noHp"
                                name="no_hp" value="{{ $data->no_hp }}">
                        </div>

                        <!-- SUBMIT -->
                        <button type="submit" class="btn btn-primary mb-2 col-md-12">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form role="form" method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profile</p>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Username</label>
                                    <input class="form-control" type="text" name="username"
                                        value="{{ old('username', auth()->user()->username) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email address</label>
                                    <input class="form-control" type="email" name="email"
                                        value="{{ old('email', auth()->user()->email) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First name</label>
                                    <input class="form-control" type="text" name="firstname"
                                        value="{{ old('firstname', auth()->user()->firstname) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last name</label>
                                    <input class="form-control" type="text" name="lastname"
                                        value="{{ old('lastname', auth()->user()->lastname) }}">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Contact Information</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Address</label>
                                    <input class="form-control" type="text" name="address"
                                        value="{{ old('address', auth()->user()->address) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">City</label>
                                    <input class="form-control" type="text" name="city"
                                        value="{{ old('city', auth()->user()->city) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Country</label>
                                    <input class="form-control" type="text" name="country"
                                        value="{{ old('country', auth()->user()->country) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Postal code</label>
                                    <input class="form-control" type="text" name="postal"
                                        value="{{ old('postal', auth()->user()->postal) }}">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">About me</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">About me</label>
                                    <input class="form-control" type="text" name="about"
                                        value="{{ old('about', auth()->user()->about) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div> -->

@endsection