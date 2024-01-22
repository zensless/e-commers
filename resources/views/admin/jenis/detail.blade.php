@extends('admin.layout.appadmin')
@section('content')
    @foreach ($jenis_produk as $jenis)
        <h1>{{$jenis->nama}}</h1>
    @endforeach
@endsection