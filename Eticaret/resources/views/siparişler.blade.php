@extends('layouts.master')
@section('title','siparişler')
@section('content')

    <div class="container">
        <div class="bg-content">
            <h2>Siparişler</h2>
            @if(count($siparişler) == 0)
                 <p>Henüz siparişiniz yok</p>
            @else
            <table class="table table-bordererd table-hover">
                <tr>
                    <th>Sipariş Kodu</th>
                    <th>Tutar</th>
                    <th>Toplam Ürün/th>
                    <th>Durum</th>
                    <th></th>
                </tr>
                <tr>
                    @foreach($siparişler as $sipariş)
                    <td>SP-{{$sipariş->id}}</td>
                    <td>{{$sipariş->siparis_tutari =((100+config('cart.tax'))/100)}}</td>
                    <td>{{ $sipariş->sepet->sepet_urun_adet() }}</td>
                    <td>{{$sipariş->durum}}</td>
                    <td>18.99</td>
                    <td>
                        Sipariş alındı, <br> Onaylandı, <br> Kargoya verildi, <br> Bir sorun var. İletişime geçin!
                    </td>
                    <td><a href="{{route('sipariş',$sipariş->id)}}" class="btn btn-sm btn-success">Detay</a></td>
                </tr>
                @endforeach
            </table>
                @endif
        </div>
    </div>



@endsection
