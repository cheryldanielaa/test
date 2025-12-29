<?php

namespace App\Imports;

use App\Models\table_d;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class NamaSalesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new table_d([
            'kode_sales' => $row['kode_sales'],
            'nama_sales'=> $row['nama_sales']
        ]);
    }
}
