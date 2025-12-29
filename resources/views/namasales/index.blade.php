@extends('layouts.admin')
@section('title')
Nama Sales
@endsection
@section('content')
<!--judulnya-->
<h1 class="h3 mb-4 text-gray-800">Daftar Nama Sales</h1>
<a class="btn btn-success" href="{{ route('nama-sales.tambah') }}">Tambah Data</a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Import Excel
</button>
<a class="btn btn-danger" href="/nama-sales/export-excel">Export Excel</a>
<a class="btn btn-warning" href="/nama-sales/export-pdf">Export PDF</a>

<!--ini buat tabel outputnya-->
<div class="card shadow mb-4 mt-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Nama Sales</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Sales</th>
                        <th>Nama Sales</th>
                        <th>Aksi Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $s)
                    <tr>
                        <td>{{ $s->kode_sales }}</td>
                        <td>{{ $s->nama_sales }}</td>
                        <td><a href="/nama-sales/edit/{{$s->kode_sales}}">Ubah</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--buat modal untuk import excel!-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/nama-sales/import" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--masukin sini buat input typenya-->
                    {{ csrf_field() }}
                    <label>Pilih file excel</label>
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection