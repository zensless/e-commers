@extends('admin.layout.appadmin')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <form action="{{route('pelanggan.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="form-group row">
        <label for="kode" class="col-4 col-form-label">Kode</label> 
        <div class="col-8">
        <input id="kode" name="kode" placeholder="Masukkan Kode" type="text" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-4 col-form-label">Nama</label> 
        <div class="col-8">
        <input id="nama" name="nama" placeholder="Masukkan Nama" type="text" required="required" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-4">Jenis Kelamin</label> 
        <div class="col-8">
            @foreach ($gender as $gr)
            @php
                $cek = (old('gr') === $gr) ? 'checked' : '';
            @endphp
                <div class="custom-control custom-radio custom-control-inline">
                    <input name="jk" id="radio_{{$loop->iteration}}" type="radio" class="custom-control-input" value="{{$gr}}"> 
                    <label for="radio_{{$loop->iteration}}" class="custom-control-label">{{$gr}}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label for="tmp_lahir" class="col-4 col-form-label">Tempat Lahir</label> 
        <div class="col-8">
        <input id="tmp_lahir" name="tmp_lahir" placeholder="Masukkan Tempat Lahir" type="text" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label> 
        <div class="col-8">
        <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-4 col-form-label">Email</label> 
        <div class="col-8">
        <input id="email" name="email" placeholder="Masukkan email" type="text" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Kartu</label> 
        <div class="col-8">
        <select id="select" name="kartu_id" class="custom-select">
            @foreach ($kartu as $k)
                <option value="{{$k->id}}">{{$k->nama}}</option>
            @endforeach
        </select>
        </div>
    </div> 
    <div class="form-group row">
        <div class="offset-4 col-8">
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
@endsection