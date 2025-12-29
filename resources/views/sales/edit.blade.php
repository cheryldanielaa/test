@extends('layouts.admin')
@section('title')
Ubah Data Sales Area
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Data Sales Area</h1>
</div>

<!--satu kode toko punya 1 area sales-->
<!--1 area sales bisa diisi bbrp kode toko-->
<form action="{{route('sales.update') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kode Toko</label>
        <input type="text" readonly name="kode_toko" value="{{ $data->kode_toko }}" class="form-control">
        <label>Area Sales</label>
        <input type="text" name="area_sales" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Ubah Data</button>
</form>
@endsection