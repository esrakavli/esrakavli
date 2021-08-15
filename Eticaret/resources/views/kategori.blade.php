@extends('layouts.master')
@section('title','Kategori')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>

            <li class="active">{{ $kategori->kategori_adi }}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $kategori->kategori_adi }}</div>
                    <div class="panel-body">

                            <h3>Alt Kategoriler</h3>
                            <div class="list-group categories">
                                @foreach($alt_kategoriler as $alt_kategori)
                                    <a href="{{route('kategori',$alt_kategori->slug)}}" class="list-group-item">
                                        <i class="fa fa-arrow-circle-right"></i>
                                        {{ $alt_kategori->kategori_adi}}
                                    </a>
                                @endforeach

                            </div>


                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">

                   sırala
                    <a href="?order=çoksatanlar" class="btn btn-default">Çok Satanlar</a>
                    <a href="?order=yeni" class="btn btn-default">Yeni Ürünler</a>
                    <hr>





                    <div class="row">
                        @if(count($urunler)==0)
                            <div class="col-md-12">Bu kategoride henüz ürün bulunmamaktadır</div>
                        @endif

                        @foreach($urunler as $urun)
                        <div class="col-md-3 product">
                            <a href="{{ route('urun',$urun->slug) }}"><img src="http://lorempixel.com/400/400/food/1"></a>
                            <p><a href="{{route('urun',$urun->slug)}}"></a>{{ $urun->urun_adi }}</p>
                            <p class="price">{{ $urun->fiyati }}</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                        @endforeach
                    </div>
                    {{ $urunler->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
