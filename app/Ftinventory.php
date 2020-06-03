<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftinventory extends Model
{
    protected $fillable = [
        "Id", "ProductSku", "ProductName", "Quantity"
    ];
    protected $table = "inventory";
}
