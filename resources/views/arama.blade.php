@extends('layouts.master')
@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('anasayfa')}}">Anasayfa</a> </li>
            <li class="active">Arama Sonucu</li>
        </ol>

        <div class="product bg-content">
            <div class="row">
                @if(count($urunler)==0)
                    <div class="col-md-12 text-center">
                        bir ürün bulunamadı
                    </div>
                @endif
                @foreach($urunler as $urun)
                    <div class="col-md-3 product">
                        <a href="{{route('urun',$urun->slug)}}">
                            <img src="http://lorempixel.com/400/485/food/1" alt="{{$urun->urun_adi}}">

                        </a>
                        <p>
                            <a href="{{route('urun',$urun->slug)}}">
                                {{$urun->urun_adi}}
                            </a>
                        </p>
                        <p class="price">{{$urun->fiyati}}</p>
                    </div>
                @endforeach
            </div>

            {{ $urunler->appends(['aranan'=>old('aranan')])->links() }}


        </div>
    </div>


@endsection
