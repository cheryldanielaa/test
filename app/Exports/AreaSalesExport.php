<?php

namespace App\Exports;

use App\Models\table_c;
use Maatwebsite\Excel\Concerns\FromCollection;

class AreaSalesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return table_c::all();
    }
}
