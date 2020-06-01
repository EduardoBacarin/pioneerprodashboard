<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftinventory extends Model
{
    protected $fillable = [
        "id", "sku", "name", "inventory"
    ];
    protected $table = "ftinventory";
}
