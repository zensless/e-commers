@extends('admin.layout.appadmin')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{url('admin/produk/store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="form-group row">
        <label for="kode" class="col-4 col-form-label">Kode</label> 
        <div class="col-8">
        <input id="kode" name="kode" type="text" class="form-control @error('kode') is-invalid @enderror" placeholder="Masukkan Kode">
        @error('kode')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-4 col-form-label">Nama</label> 
        <div class="col-8">
        <input id="nama" name="nama" placeholder="Masukkan Nama" type="text" class="form-control @error('nama') is-invalid @enderror">
        @error('nama')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="tmp_lahir" class="col-4 col-form-label">Harga Beli</label> 
        <div class="col-8">
        <input id="tmp_lahir" name="harga_beli" placeholder="Masukkan Harga Beli" type="text" class="form-control @error('harga_beli') is-invalid @enderror">
        @error('harga_beli')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="tmp_lahir" class="col-4 col-form-label">Harga Jual</label> 
        <div class="col-8">
        <input id="tmp_lahir" name="harga_jual" placeholder="Masukkan Harga Jual" type="text" class="form-control @error('harga_jual') is-invalid @enderror">
        @error('harga_jual')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="stok" class="col-4 col-form-label">Stok Barang</label> 
        <div class="col-8">
        <input id="stok" name="stok" placeholder="Masukkan Stok Barang" type="text" class="form-control @error('stok') is-invalid @enderror">
        @error('stok')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="min_stok" class="col-4 col-form-label">Minimal Stok Barang</label> 
        <div class="col-8">
        <input id="min_stok" name="min_stok" placeholder="Masukkan Min Stok Barang" type="text" class="form-control @error('min_stok') is-invalid @enderror">
        @error('min_stok')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="foto" class="col-4 col-form-label">Foto</label> 
        <div class="col-8">
        <input id="foto" name="foto" placeholder="Masukkan Min Stok Barang" type="file" class="form-control @error('foto') is-invalid @enderror">
        @error('foto')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="textarea" class="col-4 col-form-label">Deskripsi Barang</label> 
        <div class="col-8">
          <textarea id="textarea" name="deskripsi" cols="40" rows="5" class="form-control" placeholder="Masukkan Deskripsi Barang"></textarea>
          @error('kode')
          <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>
      </div> 
    <div class="form-group row">
        <label for="select" class="col-4 col-form-label">Jenis Produk</label> 
        <div class="col-8">
        <select id="select" name="jenis_produk_id" class="custom-select @error('jenis_produk_id') is-invalid @enderror">
            @foreach ($jenis_produk as $jsp)
                <option value="{{$jsp->id}}">{{$jsp->nama}}</option>
            @endforeach
        </select>
        @error('jenis_produk_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
    </div> 
    <div class="form-group row">
        <div class="offset-4 col-8">
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
@endsection