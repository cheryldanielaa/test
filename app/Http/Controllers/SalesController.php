<?php

namespace App\Http\Controllers;

use App\Exports\AreaSalesExport;
use App\Imports\AreaSalesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class SalesController extends Controller
{
    public function index(){
        $sales = DB::table('table_c')->get();
        return view('sales.index',['sales'=>$sales]);
    }

    public function showAreaForm(){
        //baca data sales tapi yg belum ada di area_sales
        // $kode_toko = DB::table('table_a')->get();
        $areaSales = DB::table('table_c')->select("kode_toko");
        //baca kode toko yang belum punya area
        $kodeBelumPunyaAreaSales = DB::table('table_a')
        ->whereNotIn('kode_toko_baru', $areaSales)
        ->get();
        return view('sales.create',['newKode'=>$kodeBelumPunyaAreaSales]);
    }

     public function storeSalesArea(Request $request)
    {
        $kodeToko = $request->kode_toko;
        $area_sales  = $request->area_sales;
        DB::table('table_c')->insert([
            'kode_toko' => $kodeToko,
            "area_sales" => $area_sales
        ]);
        //balik ke page utama!
        return redirect()->route('sales.index');
    }

    public function cariNamaArea($kode){
        $data = DB::table('table_c')->where('kode_toko','=',$kode)->first();
        $nama_area = $data?$data->area_sales:'';
        return response()->json(["nama_area" => $nama_area]);
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
        $file->move('sales', $nama_file);
        // import data
        Excel::import(new AreaSalesImport, public_path('/nama-sales/' . $nama_file));
        // alihkan halaman kembali
        return redirect()->route('sales.index');
    }

    public function exportExcel()
    {
        return Excel::download(new AreaSalesExport, 'area-sales.xlsx');
    }

    public function cetakPDF()
    {
        $sales = DB::table('table_c')->get();
        /*simpan ke format pdf--*/
        $pdf = PDF::loadview('sales.template', ['sales' => $sales]);
        return $pdf->download('area-sales');
    }

    public function edit($kode)
    {
        $data = DB::table('table_c')->where('kode_toko', '=', $kode)->first();
        return view('sales.edit', ['data' => $data]);
    }
    public function update(Request $request)
    {
        $kodeToko = $request->kode_toko;
        $nama_area = $request->area_sales;
        DB::table('table_c')
            ->where('kode_toko', $kodeToko)
            ->update([
                'area_sales' => $nama_area,
            ]);
        return redirect()->route('sales.index');
    }
}
