<?php

namespace App\Exports;

use App\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;

class PermintaanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Orders::all();
    }
}
