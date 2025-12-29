<?php

namespace App\Exports;

use App\Models\table_b;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
class TransaksiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return semua data tabel b!
        //yang direturn persis sama yang di page, jadinya kode lama udh digabung sama kode baru!
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
        return $transaksis;
    }
}
