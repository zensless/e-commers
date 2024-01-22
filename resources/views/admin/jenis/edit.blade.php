@extends('admin.layout.appadmin')
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @foreach ($jenis_produk as $jenis)
    <form action="{{url('admin/jenis_produk/update/'.$jenis->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="form-group row">
        <label for="nama" class="col-4 col-form-label">Nama Jenis Produk</label> 
        <div class="col-8">
        <input id="nama" name="nama" placeholder="Masukkan Nama Jenis Produk" type="text" class="form-control" required="required" value="{{$jenis->nama}}">
        </div>
    </div> 
    <div class="form-group row">
        <div class="offset-4 col-8">
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
    @endforeach
@endsection