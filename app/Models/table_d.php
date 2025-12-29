<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_d extends Model
{
    protected $table="table_d";
    public $timestamps = false;
    protected $fillable = ['kode_sales','nama_sales'];
}
