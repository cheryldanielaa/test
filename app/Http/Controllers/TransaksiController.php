<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Imports\TransaksiImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class TransaksiController extends Controller
{
    public function index()
    {
        //tampilin semua transaksi termasuk yang kode lama diubah ke kode baru!
        $transaksis = DB::table('table_b as b')
            ->leftJoin('table_a as a', 'a.kode_toko_lama', '=', 'b.kode_toko')
            ->selectRaw("
            CASE 
            WHEN a.kode_toko_baru IS NOT NULL 
            THEN a.kode_toko_baru 
            ELSE b.kode_toko 
            END AS kode_toko, 
            SUM(b.nominal_transaksi) as nominal_transaksi")
            ->groupByRaw("
            CASE 
            WHEN a.kode_toko_baru IS NOT NULL 
            THEN a.kode_toko_baru 
            ELSE b.kode_toko 
            END")
            ->orderBy('kode_toko', 'asc')
            ->get();
        return view('transaksi.index', ["transaksis" => $transaksis]);
    }

    public function importTransaksi(Request $request){
        $request->validate([
            //cuman terima csv aja!
           'file' => 'required|mimes:csv'
        ]);
        //atur code buat import file excel!
		$file = $request->file('file');
        // dd($file);
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
		$file->move('transaksi',$nama_file);
		// import data
		Excel::import(new TransaksiImport, public_path('/transaksi/'.$nama_file)); 
		// alihkan halaman kembali
		return redirect()->route('transaksi.index');
    }

    public function exportExcel(){
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }

    public function cetakPDF(){
         $transaksis = DB::table('table_b as b')
            ->leftJoin('table_a as a', 'a.kode_toko_lama', '=', 'b.kode_toko')
            ->selectRaw("
            CASE 
            WHEN a.kode_toko_baru IS NOT NULL 
            THEN a.kode_toko_baru 
            ELSE b.kode_toko 
            END AS kode_toko, 
            SUM(b.nominal_transaksi) as nominal_transaksi")
            ->groupByRaw("
            CASE 
            WHEN a.kode_toko_baru IS NOT NULL 
            THEN a.kode_toko_baru 
            ELSE b.kode_toko 
            END")
            ->orderBy('kode_toko', 'asc')
            ->get();
        /*simpan ke format pdf--*/
        $pdf = PDF::loadview('transaksi.template',['transaksis'=>$transaksis]);
    	return $pdf->download('transaksi');
    }
    public function showAddTransaksi()
    {
        //baca kode toko
        $kodes = DB::table('table_a')->select('kode_toko_baru')->get();
        return view('transaksi.create', ["kodes" => $kodes]);
    }

    public function simpanTransaksi(Request $request)
    {
        //kode toko
        $kodeToko = $request->kode_toko;
        //baca nominal
        $nominal  = $request->nominal;
        DB::table('table_b')->insert([
            'kode_toko' => $kodeToko,
            "nominal_transaksi" => $nominal
        ]);
        //tambahin!
        return redirect()->route('transaksi.index');
    }
}
