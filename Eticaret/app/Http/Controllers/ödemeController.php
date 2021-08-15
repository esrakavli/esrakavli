<?php

namespace App\Http\Controllers;

use App\Models\sipariş;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\kullanici_detay;

class ödemeController extends Controller
{
    public function  index()
    {
        if (!auth()->check())
        {
            return redirect()->route('kullanici.oturumaç')
                ->with('mesaj_tur','info')
                ->with('mesaj','ödeme işlemi için oturum açmanız ve ya kullanıcı kaydı yapmanız gerekmektedir');
        }
        else if (count(Cart::content())==0)
        {

            return redirect()->route('anasayfa')
                ->with('mesaj_tur','info')
                ->with('mesaj','ödeme işlemi için sepetinizde bir ürün bulunmalıdır');
        }

        $kullanici_detay = auth()->user()->detay;

        return view('ödeme',compact('kullanici_detay'));
    }

    public function ödemeyap()
    {
        $siparis = request()->all();
        $siparis['sepet_id'] = session('aktif_sepet_id');
        $siparis['banka'] ="Garanti";
        $siparis['taksit_sayisi'] = 1;
        $siparis['durum'] = "Siparişiniz alındı";
        $siparis['siparis_tutari'] = Cart::subtotal();



        sipariş::create($siparis);
        Cart::destroy();
       session()->forget('aktif_sepet_id');



        return redirect()->route('siparişler')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ödemeniz başarılı bir şekilde gerçekleştirildi.');


    }


}
