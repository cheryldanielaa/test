<?php

use App\Http\Controllers\KodeTokoController;
use App\Http\Controllers\NamaSalesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TableBController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
/*dashboardnya di daftar kode toko*/
Route::get('/', [KodeTokoController::class,'showAllKode']);
/*buat transaksi*/
Route::get('/daftar-transaksi', [TransaksiController::class,'index'])->name('transaksi.index');
Route::post('/transaksi/import', [TransaksiController::class,'importTransaksi']);
Route::get('/transaksi/export-excel', [TransaksiController::class,'exportExcel']);
Route::get('/transaksi/export-pdf', [TransaksiController::class,'cetakPDF']);
Route::get('/transaksi/tambah', [TransaksiController::class,'showAddTransaksi'])->name('transaksi.add');
Route::post('/transaksi/store', [TransaksiController::class,'simpanTransaksi'])->name('simpanTransaksi');

/*BUAT SALES*/
Route::get('/daftar-sales', [SalesController::class,'index'])->name('sales.index');
Route::get('/sales/tambah', [SalesController::class,'showAreaForm'])->name('sales.tambah');
Route::post('/sales/store', [SalesController::class,'storeSalesArea'])->name('sales.store');
Route::get('/sales/cari/{kode}', [SalesController::class,'cariNamaArea']);
Route::get('/sales/export-excel', [SalesController::class,'exportExcel']);
Route::get('/sales/export-pdf', [SalesController::class,'cetakPDF']);
Route::post('/sales/import', [SalesController::class,'import']);



/*BUAT NAMA SALES*/
Route::get('/daftar-nama-sales', [NamaSalesController::class,'index'])->name('nama-sales.index');
Route::get('/nama-sales/tambah', [NamaSalesController::class,'showAddSalesForm'])->name('nama-sales.tambah');
Route::post('/nama-sales/store', [NamaSalesController::class,'storeNamaSales'])->name('nama-sales.store');
Route::get('/nama-sales/export-excel', [NamaSalesController::class,'exportExcel']);
Route::get('/nama-sales/export-pdf', [NamaSalesController::class,'cetakPDF']);
Route::post('/nama-sales/import', [NamaSalesController::class,'import']);
Route::get('/nama-sales/edit/{kode}', [NamaSalesController::class,'edit']);
Route::post('/nama-sales/update', [NamaSalesController::class,'update'])->name('nama-sales.update');

/*BUAT KODE TOKO*/
Route::get('/kodetoko', [KodeTokoController::class,'showAllKode'])->name('kodeToko.index');
Route::get('/kode-toko/update/{id}', [KodeTokoController::class,'editKodeToko']);
Route::post('/kode-toko/update', [KodeTokoController::class,'updateKodeToko'])->name('updateKodeToko');
Route::get('/kode-toko/create', [KodeTokoController::class,'showAddToko'])->name('tambahToko');
Route::post('/kode-toko/insert', [KodeTokoController::class,'simpanToko'])->name('simpanKodeToko');
Route::get('/kode-toko/export-excel', [KodeTokoController::class,'exportExcel']);
Route::get('/kode-toko/export-pdf', [KodeTokoController::class,'cetakPDF']);
Route::post('/kode-toko/import', [KodeTokoController::class,'import']);
