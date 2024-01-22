@extends('admin.layout.appadmin')
@section('content')
    @foreach ($produk as $pd)
        <section class="py-5">
            <input type="hidden" value="{{$pd->id}}">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    @empty($pd->foto)
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{url('admin/img/no_photo.jpg')}}" alt="..." /></div>
                    @else
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{url('admin/img/')}}/{{$pd->foto}}" alt="..." /></div>
                    @endempty
                    {{-- 
                        untuk memanggil foto
                        {{asset('admin/img/'.$pd->foto)}} 

                        --}}
                    <div class="col-md-6">
                        <div class="small mb-1">Kode : {{$pd->kode}}</div>
                        <h1 class="display-5 fw-bolder">{{$pd->nama}}</h1>
                        <div class="fs-5 mb-5">
                            {{-- <span class="text-decoration-line-through">$45.00</span> --}}
                            <span>Rp.{{$pd->harga_jual}}</span>
                        </div>
                        <p class="lead">{{$pd->deskripsi}}</p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="{{$pd->stok}}" style="max-width: 3rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection