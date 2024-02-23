<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;

class AnggotaController extends Controller
{
    public function index()
    {
        //get posts
        $anggota = Anggota::latest()->paginate(5);
    
        //render view with posts
        return view('pages.anggota', compact('anggota'));
    }

    public function addanggota()
    {    
        //render view with posts
        return view('pages.tambah-anggota');
    }

    public function postanggota(Request $request)
    {
        //create post
        Anggota::create([
            'nis'               => $request->nis,
            'nama_siswa'         => $request->nama_siswa,
            'id_kelas'          => $request->id_kelas,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'no_hp'             => $request->no_hp,
            'unique_code'       => substr(sha1($request->nama_siswa) . sha1($request->nis), 0, 16)
        ]);
        
        //redirect to index
        return redirect('anggota')->with(['success' => 'Data Berhasil Disimpan!']);
       
    }

    public function editanggota($id_siswa)
    {
        // Temukan data anggota berdasarkan id_siswa
        $data = Anggota::find($id_siswa);
    
        // Tampilkan view edit-anggota dengan data anggota
        return view('pages.edit-anggota', compact('data'));
    }
    
    public function updateanggota(Request $request, $id_siswa)
    {
        // Validasi form sesuai kebutuhan
        $request->validate([
            // ...
        ]);
    
        // Update data anggota berdasarkan id_siswa
        $anggota = Anggota::find($id_siswa);
        $anggota->update($request->all());
    
        // Redirect ke halaman anggota dengan pesan sukses
        return redirect('anggota')->with('success', 'Data Berhasil Diperbarui!');
    }
    
    public function deleteanggota($id_siswa)
    {
        $data = Anggota::find($id_siswa);
        $data->delete();        

        return redirect('anggota')->with(['success' => 'Data Berhasil Dihapus!']);
    }


    //generate QR Code
    public function generateQRCode()
    {
        // Ambil data unique_code dari database
        $data = Anggota::all();

        foreach ($data as $item) {
            $uniqueCode = $item->unique_code;
            $nama = $item->nama_siswa;

            // Generate QR Code dan simpan sebagai file PNG
            QrCode::format('svg')->size(300)->generate($uniqueCode, public_path("qr-code/{$nama}.svg"));
        }

        return redirect('anggota')->with(['success' => 'QR Code Berhasil Di Generate!']);
    }

    

    public function convertSvgToPng($svgPath, $outputPath)
    {
        Browsershot::html(file_get_contents($svgPath))
            ->setOption('no-sandbox') // Jika menggunakan Linux
            ->save($outputPath);

        return $outputPath;
    }
}