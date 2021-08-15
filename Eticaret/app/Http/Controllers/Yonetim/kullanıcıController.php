<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\kullanici;
use App\Models\kullanici_detay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class kullanıcıController extends Controller
{
    public function oturumac()
    {

        if (request()->isMethod('POST')) {
            $this->validate(request(), [
                'email' => 'required|email',
                'sifre' => 'required'
            ]);
            $credentials = [
                'email' => request()->get('email'),
                'password' => request()->get('sifre'),
                'yonetici_mi' => 1,
                'aktif_mi' => 1
            ];
            if (Auth::guard('yonetim')->attempt($credentials, request()->has('benihatirla'))) {
                return redirect()->route('yonetim.anasayfa');
            } else {
                return back()->withInput()->withErrors(['email' => 'Giriş Hatali!']);
            }
        }
        return view('yonetim.oturumac');
    }

    public function oturumukapat()
    {
        Auth::guard('yonetim')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('yonetim.oturumac');
    }

    public function index()
    {
      if(request()->filled('aranan'))
      {
          request()->flash();
          $aranan =request('aranan');
          $list =kullanici::where('adsoyad','like',"%$aranan%")
              ->orWhere('email','like',"%$aranan%")
              ->orderByDesc('created_at')
              ->paginate(8);
       }
      else{
          $list = kullanici::orderBy('created_at')->paginate(8);
      }

        return view('yonetim.kullanici.index', compact('list'));
    }

    public function form($id = 0)
    {
        $entry = new kullanici;
        if ($id > 0) {
            $entry = kullanici::find($id);
        }
        return view('yonetim.kullanici.form', compact('entry'));
    }

    public function kaydet($id = 0)
    {
        $this->validate(request(), [
            'adsoyad' => 'required',
            'email' => 'required|email'
        ]);

        $data = request()->only('adsoyad', 'email');
        if(request()->filled('sifre'))
        {
            $data['sifre'] =Hash::make(request('sifre'));
        }

        $data['aktif_mi'] = request()->has('aktif_mi') && request('aktif_mi')==1 ? 1 : 0;
        $data['yonetici_mi'] = request()->has('aktif_mi') && request('yonetici_mi')==1 ? 1 : 0;


        if ($id > 0) {
            //guncelle
            $entry = kullanici::where('id', $id)->firstOrFail();
            $entry->update($data);

            kullanici_detay::updateOrCreate(
                ['kullanici_id'=>$entry->id],
                [
                    'adres'=>request('adres'),
                    'telefon'=>request('telefon'),
                    'ceptelefonu'=>request('ceptelefonu')
                    ]
            );
        }
        else
        {
            $entry =kullanici::create($data);
        }
        return redirect()
            ->route('yonetim.kullanici.duzenle',$entry->id)
            ->with('mesaj',($id>0 ? 'Guncellendi' : 'Kaydedildi'))
            ->with('mesaj_tur','success');
    }
    public function sil($id)
    {
        kullanici::destroy($id);
        return redirect()
            ->route('yonetim.kullanici')
            ->with('mesaj','kayıt silindi')
            ->with('mesaj_tur','success');
    }
}
