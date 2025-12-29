<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_c extends Model
{
    protected $table="table_c";
    public $timestamps = false;
    protected $fillable = ['kode_toko','kode_sales'];
}
