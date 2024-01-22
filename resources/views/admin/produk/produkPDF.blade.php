<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3 align="center">Data Produk</h3>
    <table class='table table-bordered' align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Minimal Stok</th>
                <th>Jenis Produk</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($produk as $pr)
                <tr>
                    <td>{{$id++}}</td>
                    <td>{{$pr->kode}}</td>
                    <td>{{$pr->nama}}</td>
                    <td>{{$pr->harga_beli}}</td>
                    <td>{{$pr->harga_jual}}</td>
                    <td>{{$pr->stok}}</td>
                    <td>{{$pr->min_stok}}</td>
                    <td>{{$pr->jenis}}</td>
                </tr>
            @endforeach
    </table>

</body>
</html>