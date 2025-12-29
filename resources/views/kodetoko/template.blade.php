<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kode Toko - PDF</title>
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
    <center>Daftar Kode Toko</center>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Kode Toko Baru</th>
                <th>Kode Toko Lama</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kodes as $kode)
            <tr>
                <td>{{ $kode->kode_toko_baru }}</td>
                <td>{{ $kode->kode_toko_lama }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>