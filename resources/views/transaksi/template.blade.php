<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi - PDF</title>
    <style>
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        table,
        table th,
        table td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <center>Daftar Transaksi</center>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Kode Toko</th>
                <th>Nominal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->kode_toko }}</td>
                <td>{{ $transaksi->nominal_transaksi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>