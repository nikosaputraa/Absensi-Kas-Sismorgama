<table class="table align-items-center mb-0" id="dataAbsensiContainer">
    <thead>
        <tr>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                No
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                NIM
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Nama Mahasiswa
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Divisi</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Waktu Absen</th>
        </tr>
    </thead>
    <?php $i = 1; ?>
    @foreach ($dataPresensi as $presensi)
    <tbody>
        <tr>
            <td td class="align-middle text-center text-sm"><?= $i ?></td>
            <td>
                <p class="text-sm font-weight-bold mb-0">{{ $presensi->nim }}</p>
            </td>
            <td>
                <p class="text-sm font-weight-bold mb-0">{{ $presensi->nama_mahasiswa }}</p>
            </td>
            <td class="align-middle text-center text-sm">
                <p class="text-sm font-weight-bold mb-0">
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
                <p class="text-sm font-weight-bold mb-0">
                    {{ $presensi->waktu_absen }}</p>
            </td>
        </tr>
    </tbody>
    <?php $i++; ?>
    @endforeach
</table>