<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Anggota;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function show()
    {
        return view('pages.absensi');
    }


    public function sesiAbsensi(Request $request)
    {
        //create post
        Sesi::create([
            'nama_kegiatan'   => $request->nama_kegiatan,
            'tanggal'         => $request->tanggal,
            'judul'         => $request->judul,
        ]);
        
        //redirect to index
        return redirect('absensi')->with(['success' => 'Sesi Berhasil Dibuat!']);
       
    }

    public function deleteSesi($id_sesi)
    {
        try {
            // Menggunakan transaksi untuk memastikan konsistensi data
            DB::beginTransaction();

            // Hapus data Absensi
            Absensi::where('id_sesi', $id_sesi)->delete();

            // Hapus data Anggota
            Sesi::where('id_sesi', $id_sesi)->delete();

            // Commit transaksi jika berhasil
            DB::commit();

            return redirect('absensi')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect dengan pesan kesalahan
            return redirect('absensi')->with(['error' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }

    public function scanAbsen($id_sesi)
    {
        $data = Sesi::find($id_sesi);
        $dataPresensi = Absensi::where('id_sesi', $id_sesi)->get();

        return view('pages.absen-scan', compact('data', 'dataPresensi'));
    }

    public function scanUpdate($id_sesi)
    {
        $dataPresensi = Absensi::where('id_sesi', $id_sesi)->get();

        return view('pages.absen.update-absen', compact('dataPresensi'));
    }


    public function processPresensi(Request $request, $id_sesi)
    {
        $uniqueCode = $request->input('unique_code');

        $waktuAbsen = Carbon::now('Asia/Jakarta');
        // Cocokkan dengan data di database
        $anggota = Anggota::where('unique_code', $uniqueCode)->first();

        if ($anggota) {
            // Jika anggota ditemukan, simpan data ke tb_presensi
            Absensi::create([
                'nim' => $anggota->nis,
                'nama_mahasiswa' => $anggota->nama_siswa,
                'divisi' => $anggota->id_kelas,
                'id_sesi' => $id_sesi,
                'waktu_absen' => $waktuAbsen,
            ]);

         return response()->json(['success' => true]);

        } else {
    
            return response()->json(['success' => false]);
        }
    }

    public function detailAbsen($id_sesi)
    {
        $dataPresensi = Absensi::where('id_sesi', $id_sesi)->get();

        return view('pages.absen.detail-absen', compact('dataPresensi'));
    }
}