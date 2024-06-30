@extends('layouts.frontend')

@section('content')
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                                <div class="slider-nav-img">
                                    @if ($produk->gambar == NULL)
                                    <img  width="200" src="{{asset('images/blank.jpg')}}">
                                    @else
                                    <img  width="200" src="{{asset('images/'.$produk->gambar) }}" alt="Gambar Produk">
                                    @endif
                                </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title"><h2>{{$produk->nama}}</h2></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="price">
                                    <h4>Price:</h4>
                                    <p>{{ 'IDR'.$produk->harga }}</p>
                                </div>
                                <div class="action">
                                    <a class="btn" href="{{route('addCart',$produk->id)}}"><i class="fa fa-shopping-cart"></i>Tambahkan ke Keranjang</a>
                                    <a class="btn" href="#"><i class="fa fa-shopping-bag"></i>Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
