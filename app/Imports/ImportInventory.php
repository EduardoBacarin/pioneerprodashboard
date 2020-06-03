<?php

namespace App\Imports;

use App\Ftinventory;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportInventory implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */  
    public function model(array $row)
    {
        return new Ftinventory([
            'ProductSKU' => @$row[0],
            'ProductName' => @$row[1],
            'Quantity' => @$row[2],
        ]);
    }
}
