<?php

namespace App\Http\Controllers;

use App\Exports\KodeTokoExport;
use App\Imports\KodeTokoImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class KodeTokoController extends Controller
{
    public function showAllKode()
    {
        //baca data di database! >> query builder aja!
        $kodes = DB::table('table_a')->orderBy("kode_toko_baru", "ASC")->get();
        return view('kodetoko.index', ["kodes" => $kodes]);
    }
    public function editKodeToko($id)
    {
        //buat show formnya!
        return view('kodetoko.update', ["kode_lama" => $id]);
    }

    public function updateKodeToko(Request $request)
    {
        $kodeSaatIni = trim($request->kode_lama);
        $kodeBaru    = trim($request->kode_baru);
        //cek dulu apakah datanya ada gak di kode baru/kode lama biar gk duplicated!
        $exists = DB::table('table_a')
            ->where('kode_toko_baru', $kodeBaru)
            ->orWhere('kode_toko_lama', $kodeBaru)
            ->exists();
        //klo blm ada!
        if (!$exists) {
            //buat update di db! >> update kode toko lama jd saat ini
            //kode baru sesuai inputan kode baru!
            DB::table('table_a')
                ->where('kode_toko_baru', $kodeSaatIni)
                ->update([
                    'kode_toko_baru' => $kodeBaru,
                    'kode_toko_lama' => $kodeSaatIni
                ]);
            return redirect()->route('kodeToko.index');
        } else {
            return redirect()->route('kodeToko.index');
        }
    }

    public function showAddToko()
    {
        //baca data di database! >> query builder aja!
        return view('kodetoko.create');
    }
    public function simpanToko(Request $request)
    {
        $kodeBaru = $request->kode_baru;
        //cek dulu ada atau gak kode toko baru/lama yg punya kode sessuai yang diinput!
        $exists = DB::table('table_a')
            ->where('kode_toko_baru', $kodeBaru)
            ->orWhere('kode_toko_lama', $kodeBaru)
            ->exists();
        //klo ada maka kirim pesan!
        if ($exists) {
            return redirect()->route('tambahToko')->with('status', 'Maaf, kode toko sudah pernah ditambahkan!');
        } else {
            //klo gak ada maka tambahin!
            DB::table('table_a')->insert([
                'kode_toko_baru' => $kodeBaru
            ]);
            return redirect()->route('kodeToko.index')->with('status', 'Selamat, data berhasil ditambahkan!');
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            //cuman terima csv aja!
            'file' => 'required|mimes:csv'
        ]);
        //atur code buat import file excel!
        $file = $request->file('file');
        // dd($file);
        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('kode-toko', $nama_file);
        // import data
        Excel::import(new KodeTokoImport, public_path('/kode-toko/' . $nama_file));
        // alihkan halaman kembali
        return redirect()->route('kodeToko.index');
    }

    public function exportExcel()
    {
        return Excel::download(new KodeTokoExport, 'kode-toko.xlsx');
    }

    public function cetakPDF()
    {
        $kodes = DB::table('table_a')->orderBy("kode_toko_baru", "ASC")->get();
        /*simpan ke format pdf--*/
        $pdf = PDF::loadview('kodetoko.template', ['kodes' => $kodes]);
        return $pdf->download('kode-toko');
    }
}
