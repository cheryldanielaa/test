@extends('layouts.admin')
@section('title')
Tambah Nama Sales
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Nama Sales</h1>
</div>

<!--id sales toko itu terbentuk dari area_sales + jumlah_salesnya!-->
<form action="{{ route('nama-sales.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kode Toko Baru</label>
        <select name="kode_toko" class="form-control kode_toko">
            @foreach ($kodeToko as $kode)
            <option value="{{ $kode->kode_toko }}">{{ $kode->kode_toko }}</option>
            @endforeach
        </select>
        <label>Area Sales</label>
        <input type="text" name="area_sales" class="form-control" readonly id="area_sales">
        <label>Nama Sales</label>
        <input type="text" name="nama_sales" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
<script>
    $(".kode_toko").change(function() {
        let angka = $(this).val();
        $.ajax({
            url: "/sales/cari/" + angka,
            method: "GET",
            success: function(response) {
                $("#area_sales").val(response.nama_area);
            },
        });
    });
</script>
@endsection