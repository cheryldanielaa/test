@extends('layouts.admin')
@section('title')
Tambah Kode Toko
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Kode Toko</h1>
</div>
<form action="{{ route('simpanKodeToko') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kode Toko Baru</label>
        <input type="number" class="form-control" name="kode_baru" placeholder="Input Kode Toko Baru">
        <small class="form-text text-muted">Kode toko harus berupa angka.</small>
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
@endsection