<?php

namespace App\Imports;

use App\Models\table_b;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class TransaksiImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new table_b([
            //file yang diimport ada headernya!
            //kode_toko, nominal_transaksi!
            'kode_toko' => $row['kode_toko'],
            'nominal_transaksi'=> $row['nominal_transaksi']
        ]);
    }
}
