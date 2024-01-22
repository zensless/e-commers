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

    @foreach ($produk as $pr)
    <form action="{{url('admin/produk/update/'.$pr->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group row">
                <label for="kode" class="col-4 col-form-label">Kode</label> 
                <div class="col-8">
                <input id="kode" name="kode" placeholder="Masukkan Kode" type="text" class="form-control @error('kode') is-invalid @enderror" value="{{$pr->kode}}">
                @error('kode')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-4 col-form-label">Nama</label> 
                <div class="col-8">
                <input id="nama" name="nama" placeholder="Masukkan Nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{$pr->nama}}">
                @error('nama')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="tmp_lahir" class="col-4 col-form-label">Harga Beli</label> 
                <div class="col-8">
                <input id="tmp_lahir" name="harga_beli" placeholder="Masukkan Harga Beli" type="text" class="form-control @error('harga_beli') is-invalid @enderror" value="{{$pr->harga_beli}}">
                @error('harga_beli')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="tmp_lahir" class="col-4 col-form-label">Harga Jual</label> 
                <div class="col-8">
                <input id="tmp_lahir" name="harga_jual" placeholder="Masukkan Harga Jual" type="text" class="form-control @error('harga_jual') is-invalid @enderror" value="{{$pr->harga_jual}}">
                @error('harga_jual')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-4 col-form-label">Stok Barang</label> 
                <div class="col-8">
                <input id="email" name="stok" placeholder="Masukkan Stok Barang" type="text" class="form-control @error('stok') is-invalid @enderror" value="{{$pr->stok}}">
                @error('stok')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-4 col-form-label">Minimal Stok Barang</label> 
                <div class="col-8">
                <input id="email" name="min_stok" placeholder="Masukkan Min Stok Barang" type="text" class="form-control @error('min_stok') is-invalid @enderror" value="{{$pr->min_stok}}">
                @error('min_stok')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="foto" class="col-4 col-form-label">Foto</label> 
                <div class="col-8">
                <input id="foto" name="foto" type="file" class="form-control @error('foto') is-invalid @enderror">
                @if (!empty($pr->foto))
                    <img src="{{url('admin/img')}}/{{$pr->foto}}" alt="" srcset="">
                @endif
                @error('foto')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-4 col-form-label">Deskripsi Barang</label> 
                <div class="col-8">
                  <textarea id="textarea" name="deskripsi" cols="40" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi Barang">{{$pr->deskripsi}}</textarea>
                  @error('deskripsi')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
              </div> 
            <div class="form-group row">
                <label for="select" class="col-4 col-form-label">Jenis Produk</label> 
                <div class="col-8">
                <select id="select" name="jenis_produk_id" class="custom-select @error('jenis_produk_id') is-invalid @enderror">
                    @foreach ($jenis_produk as $jsp)
                    @php $sel = ($jsp->id == $pr->jenis_produk_id) ? 'selected' : ''; @endphp
                        <option value="{{$jsp->id}}" {{$sel}}>{{$jsp->nama}}</option>
                    @endforeach
                </select>
                @error('jenis_produk_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
            </div> 
            <div class="form-group row">
                <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-warning">Submit</button>
                </div>
            </div>
        </form>
@endforeach
@endsection