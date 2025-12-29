<?php

namespace App\Exports;

use App\Models\table_d;
use Maatwebsite\Excel\Concerns\FromCollection;

class NamaSalesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return table_d::all();
    }
}
