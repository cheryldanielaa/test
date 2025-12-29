<?php

namespace App\Exports;

use App\Models\table_a;
use Maatwebsite\Excel\Concerns\FromCollection;

class KodeTokoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return table_a::all();
    }
}
