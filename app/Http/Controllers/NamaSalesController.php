<?php

namespace App\Http\Controllers;

use App\Exports\NamaSalesExport;
use App\Imports\NamaSalesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class NamaSalesController extends Controller
{
    public function index()
    {
        $datas = DB::table('table_d')->get();
        return view('namasales.index', ["sales" => $datas]);
    }
    public function showAddSalesForm()
    {
        //baca kode area yang udh punya sales!
        $kodeTokos = DB::table('table_c')->get();
        //baca data semua sales yang ada!
        // $daftar_sales = DB::
        return view('namasales.create', ["kodeToko" => $kodeTokos]);
    }

    //simpan data sales!
    public function storeNamaSales(Request $request)
    {
        $area_sales = $request->area_sales;
        //cari dulu daftar sales yg di area skrg mana
        //ambil idnya sama urutin dr yang terbesar! >> terus yg baru kodenya di +1
        $sales_di_area_sekarang = DB::table('table_d')
            ->select('kode_sales')
            //ubah ke bentuk integer biar bs disorting!
            ->selectRaw('CAST(SUBSTRING(kode_sales, 2) AS UNSIGNED) as nomor_sales')
            ->where(DB::raw('SUBSTRING(kode_sales, 1, 1)'), '=', $area_sales)
            ->orderBy('nomor_sales', 'desc')
            ->first();
        // ambil id salesnya
        $idSalesBaru = $sales_di_area_sekarang ? $sales_di_area_sekarang->nomor_sales + 1 : 1;
        // buat kode sales baru
        $kode_sales_baru = $area_sales . $idSalesBaru;

        //buat query insert!
        $nama_sales = $request->nama_sales;
        DB::table('table_d')->insert([
            'kode_sales' => $kode_sales_baru,
            "nama_sales" => $nama_sales
        ]);
        return redirect()->route('nama-sales.index');
    }


    /*import + export*/
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
        $file->move('nama-sales', $nama_file);
        // import data
        Excel::import(new NamaSalesImport, public_path('/nama-sales/' . $nama_file));
        // alihkan halaman kembali
        return redirect()->route('nama-sales.index');
    }

    public function exportExcel()
    {
        return Excel::download(new NamaSalesExport, 'nama-sales.xlsx');
    }

    public function cetakPDF()
    {
        $datas = DB::table('table_d')->get();
        /*simpan ke format pdf--*/
        $pdf = PDF::loadview('namasales.template', ['sales' => $datas]);
        return $pdf->download('nama-sales');
    }

    public function edit($kode)
    {
        $data = DB::table('table_d')->where('kode_sales', '=', $kode)->first();
        return view('namasales.edit', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $kode_sales = $request->kode_sales;
        $nama_sales = $request->nama_sales;

        //update nama where kode = kode sales
        DB::table('table_d')
            ->where('kode_sales', $kode_sales)
            ->update([
                'nama_sales' => $nama_sales,
            ]);
        return redirect()->route('nama-sales.index');
    }
}
