<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Area Sales-PDF</title>
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
    <center>Daftar Area Sales</center>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Kode Toko</th>
                <th>Area Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $s)
            <tr>
                <td>{{ $s->kode_toko }}</td>
                <td>{{ $s->area_sales }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>