@extends('layouts.master')

@section('title','sepet')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')

            @if(count(Cart::content())>0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Adet Fiyatı</th>
                    <th>Adet</th>
                    <th>Tutar</th>

                </tr>
                @foreach( Cart::content() as $urunCartItem)
                <tr>
                    <td>
                        <a href="{{ route('urun',$urunCartItem->id) }}">
                            <img src="http://lorempixel.com/120/100/food/2">
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('urun',$urunCartItem->id) }}">
                        {{$urunCartItem->name}}
                        </a>
                        <form action="{{ route('sepet.kaldir',$urunCartItem->rowId) }}"  method="post">
                            {{csrf_field()}}
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn btn-danger btn-xs" value="Sepetten Kaldır">
                        </form>
                    </td>
                    <td>{{ $urunCartItem->price }}</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default urun-adet-azalt" data-id="{{$urunCartItem->rowId}}" data-adet="{{$urunCartItem->qty-1 }}">-</a>

                        <span style="padding: 10px 20px">{{ $urunCartItem->qty }}</span>
                        <a href="#" class="btn btn-xs btn-default urun-adet-arttır" data-id="{{$urunCartItem->rowId}}" data-adet="{{$urunCartItem->qty+1}}">+</a>
                    </td>
                    <td>18.99</td>
                    <td class="text-right">
                       {{ $urunCartItem-> subtotal }} tl
                    </td>
                </tr>

                @endforeach
                <tr>

                    <th colspan="4" class="text-right">Alt Toplam</th>
                    <th class="text-right">{{ Cart::subtotal() }} tl</th>

                </tr>
                <tr>

                    <th colspan="4" class="text-right">KDV</th>
                    <th class="text-right">{{ Cart::tax() }} tl</th>

                </tr>
                <tr>

                    <th colspan="4" class="text-right">Genel Toplam</th>
                    <th class="text-right">{{ Cart::total() }} tl</th>

                </tr>
            </table>


                <form action="{{route('sepet.boşalt')}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">
                </form>
                <a href="{{route('ödeme')}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            @else
                <p>Sepetinizde ürün yok!</p>
            @endif


        </div>
    </div>
@endsection

@section('footer')
   <script>
       $(function (){
           $('.urun-adet-arttır,.urun-adet-azalt').on('click',function (){
               var id = $(this).attr('data-id');
               var adet = $(this).attr('data-adet');
               $.ajax({
                   type: 'PATCH',
                   url:'{{url('sepet/guncelle')}}/' + id,
                   data: {adet:  adet},
                   success:function (result){
                       window.location.href = '{{route('sepet')}}';
                   }
               });
           });

       });



   </script>


@endsection
