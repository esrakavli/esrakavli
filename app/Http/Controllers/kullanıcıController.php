<?php

namespace App\Http\Controllers;

use App\Mail\KullaniciKayitMail;
use App\Models\kullanici;
use App\Models\kullanici_detay;
use App\Models\sepet;
use App\Models\SepetUrun;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class kullanıcıController extends Controller
{
    public function giris_form()
    {
        return view('kullanıcı.oturumac');
    }
    public function giris()
    {
        $this->validate(request(),[
           'email'=>'required|email',
            'sifre'=>'required'
        ]);

        $credentials = [
            'email'=>request('email'),
            'password'=>request('sifre'),
            'aktif_mi' => 1
        ];

        if(auth()->attempt($credentials,request()->has('benihatirla')))
        {
            request()->session()->regenerate();


               $aktif_sepet_id =sepet::firstOrCreate(['kullanici_id'=>auth()->id()])->id;

                session()->put('aktif_sepet_id',$aktif_sepet_id);
                if (Cart::count()>0)
                {

                    foreach (Cart::content() as $cartItem)
                    {
                        SepetUrun::updateOrCreate(
                            ['sepet_id'=>$aktif_sepet_id,'urun_id'=> $cartItem->id],
                            ['adet'=>$cartItem->qty,'fiyati'=>$cartItem->price,'durum'=>'Beklemede']
                        );

                    }


                }
                Cart::destroy();
                $sepetUrunler =SepetUrun::where('sepet_id',$aktif_sepet_id)->get();

                foreach ($sepetUrunler as $sepetUrun)
                {
                    Cart::add($sepetUrun->urun->id,$sepetUrun->urun->urun_adi,$sepetUrun->adet,$sepetUrun->fiyati,['slug'=>$sepetUrun->urun->slug]);
                }

            return redirect()->intended('/');

        }
        else{
            $errors =['email'=>'hatalı giriş'];
            return back()->withErrors($errors);
        }

    }

    public function  kaydol_form()
    {
        return view('kullanıcı.kaydol');
    }
    public function kaydol()
    {
       $this->validate(request(),[
           'adsoyad'=>'required|min:5|max:60',
           'email'=>'required|email|unique:kullanicis',
           'sifre'=>'required|confirmed|min:5|max:15'
       ]);

      $kullanici = kullanici::create([
          'adsoyad'=>request('adsoyad'),
           'email'=>request('email'),
          'sifre'=>Hash::make(request('sifre')),
          'aktivasyon_anahtari'=>\Illuminate\Support\Str::random(60),
          'aktif_mi'=>0


      ]);
      $kullanici->detay()->save(new kullanici_detay());

      Mail::to(request('email'))->send(new KullaniciKayitMail($kullanici));
      auth()->login($kullanici);
      return redirect()->route('anasayfa');
    }
    public function aktiflestir($anahtar)
    {
       $kullanici = kullanici::where('aktivasyon_anahtari',$anahtar)->first();
       if (!is_null($kullanici))
       {
           $kullanici->aktivasyon_anahtari = null;
           $kullanici->aktif_mi = 1;
           $kullanici->save();
           return redirect()->to('/')
               ->with('mesaj','Kullanıcı kaydınız aktifleştirildi')
               ->with('mesaj_tur','success');
       }
       else{
           return redirect()->to('/')
               ->with('mesaj','Kullanıcı kaydınız bulunamadı')
               ->with('mesaj_tur','warning');
       }
    }
    public function oturumukapat()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasayfa');
    }
}
