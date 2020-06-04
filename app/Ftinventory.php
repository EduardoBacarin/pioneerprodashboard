<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftinventory extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        "Id","ProductSKU", "ProductName", "Quantity"
    ];
    protected $table = "inventory";
}
