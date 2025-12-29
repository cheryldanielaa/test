@extends('layouts.admin')
@section('title')
Tambah Kode Toko
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Transaksi</h1>
</div>
<form action="{{ route('simpanTransaksi') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kode Toko Baru</label>
        <select name="kode_toko" class="form-control">
            @foreach ($kodes as $kode)
                <option value="{{ $kode->kode_toko_baru }}">{{ $kode->kode_toko_baru }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Nominal Transaksi (Rp)</label>
        <input type="number" name="nominal" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
@endsection