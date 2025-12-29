@extends('layouts.admin')
@section('title')
Update Kode Toko
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update Kode Toko</h1>
</div>
<form action="{{ route('updateKodeToko') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kode Toko Baru</label>
        <input type="number" class="form-control" name="kode_baru" placeholder="Input Kode Toko Baru">
        <small class="form-text text-muted">Kode toko harus berupa angka.</small>
    </div>
    <div class="form-group">
        <label>Kode Toko Lama</label>
        <!--pakai readonly biar value gk bs diubah, klo disabled value gk bs dikirim-->
        <input type="number" class="form-control" name="kode_lama" value="{{ $kode_lama }}" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection