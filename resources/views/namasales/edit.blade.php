@extends('layouts.admin')
@section('title')
Ubah Nama Sales
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Nama Sales</h1>
</div>

<!--id sales toko itu terbentuk dari area_sales + jumlah_salesnya!-->
<form action="{{ route('nama-sales.update') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kode Sales</label>
        <input type="text" name="kode_sales" class="form-control" readonly id="kode_sales" value="{{ $data->kode_sales }}">
        <label>Nama Sales</label>
        <input type="text" name="nama_sales" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
@endsection