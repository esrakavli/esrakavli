@extends('layouts.master')
@section('title','sipariş detayı')
@section('content')

    <div class="container">
        <div class="bg-content">
            <a href="{{route('siparişler')}}" class="btn btn-xs btn-primary">
                <i class="glyphicon glyphicon-arrow-left"> SiparişlereDön </i>
            </a>
            <h2>Sipariş (SP-{{$sipariş->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>
                @foreach($sipariş->sepet->sepet_urunler as $sepet_urun)
                <tr>
                    <td style="width: 120px">
                        <a href="{{route('urun',$sepet_urun->urun->slug)}}">
                            <img src="http://lorempixel.com/120/100/food/2">
                        </a>
                       </td>
                    <td>
                        <a href="{{route('urun',$sepet_urun->urun->slug)}}">
                            {{ $sepet_urun->urun->urun_adi}}
                        </a>
                    </td>

                    <td>{{ $sepet_urun->tutar }}</td>
                    <td>{{ $sepet_urun->adet }}</td>
                    <td>{{$sepet_urun->tutar* $sepet_urun->adet}}</td>
                    <td>
                         {{ $sepet_urun->durum }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar</th>
                    <td colspan="2" class="text-right">{{$sipariş->siparis_tutari}} tl</td>

                </tr>
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar (KDV'li)</th>
                    <td colspan="2" class="text-right">{{ $sipariş->siparis_tutari*((100+config('cart.tax'))/100) }} tl</td>

                </tr>
                <tr>
                    <th colspan="4" class="text-right">Sipariş Durumu</th>
                    <td colspan="2" class="text-right">{{ $sipariş->durum }}</td>

                </tr>



            </table>
        </div>
    </div>
@endsection
