@extends('layouts.admin')
@section('title')
Tambah Sales Area
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data Sales Area</h1>
</div>

<!--satu kode toko punya 1 area sales-->
<!--1 area sales bisa diisi bbrp kode toko-->
<form action="{{route('sales.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kode Toko Baru</label>
        <select name="kode_toko" class="form-control">
        @foreach ($newKode as $kode)
        <option value="{{ $kode->kode_toko_baru }}">{{ $kode->kode_toko_baru }}</option>
        @endforeach
        </select>
        <label>Area Sales</label>
        <input type="text" name="area_sales" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
@endsection