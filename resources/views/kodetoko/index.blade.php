@extends('layouts.admin')
@section('title')
Daftar Kode Toko
@endsection
@section('content')
<h1 class="h3 mb-4 text-gray-800">Daftar Kode Toko</h1>
<a class="btn btn-success" href="{{ route('tambahToko') }}">Tambah Data</a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Import Excel
</button>
<a class="btn btn-danger" href="/kode-toko/export-excel">Export Excel</a>
<a class="btn btn-warning" href="/kode-toko/export-pdf">Export PDF</a>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kode Toko</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Toko Baru</th>
                        <th>Kode Toko Lama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kodes as $kode)
                    <tr>
                        <td>{{ $kode->kode_toko_baru }}</td>
                        <td>{{ $kode->kode_toko_lama }}</td>
                        {{-- -klo misal kode toko lamanya blm diisi bs update delete --}}
                        @if(!$kode->kode_toko_lama)
                            <td><a href="{{ url('/kode-toko/update/'.$kode->kode_toko_baru) }}">Ubah</a></td>
                        @else
                        <td></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/kode-toko/import" method="post" enctype="multipart/form-data">
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