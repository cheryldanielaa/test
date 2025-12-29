<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_b extends Model
{
    //buat simpan transaksi!
    protected $table="table_b";
    public $timestamps = false;
    protected $fillable = ['kode_toko','nominal_transaksi'];
}
