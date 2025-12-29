<?php

namespace App\Imports;

use App\Models\table_c;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AreaSalesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new table_c([
            'kode_toko' => $row['kode_toko'],
            'area_sales'=> $row['area_sales']
        ]);
    }
}
