<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_a extends Model
{
    protected $table="table_a";
    public $timestamps = false;
    protected $fillable = ['kode_toko_lama','kode_toko_baru'];
}
