<?php

namespace App\Http\Controllers;

use App\Models\sepet;
use App\Models\SepetUrun;
use App\Models\urun;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class sepetController extends Controller
{
    public function index()
    {

        return view('sepet');
    }
    public function ekle()
    {
        $urun = urun::find(request('id'));
         $cartItem =Cart::add($urun->slug,$urun->urun_adi,1,$urun->fiyati);

         if (auth()->check())

         {
             $aktif_sepet_id =session('aktif_sepet_id');
             if(!isset($aktif_sepet_id)){

                 $aktif_sepet =sepet::create(
                     [
                         'kullanici_id' =>auth()->id()
                     ]
                 );
                 $aktif_sepet_id = $aktif_sepet->id;
                 session()->put('aktif_sepet_id',$aktif_sepet_id);

             }
             SepetUrun::updateOrCreate(

                 ['sepet_id'=>$aktif_sepet_id,'urun_id'=>$urun->id],
                 ['adet'=>$cartItem->qty,'tutar'=>$urun->fiyati,'durum'=>'beklemede']

             );



         }

        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','ürün sepete eklendi');

    }
    public function kaldir($rowId)
    {
        if (auth()->check())
        {
            $aktif_sepet_id =session('aktif_sepet_id');
            $cartItem =Cart::get($rowId);
            SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
        }



        Cart::remove($rowId);

        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','ürün sepetten kaldırıldı');

    }
    public function boşalt()
    {

        if (auth()->check())
        {
            $aktif_sepet_id =session('aktif_sepet_id');

            SepetUrun::where('sepet_id',$aktif_sepet_id)->delete();
        }


        Cart::destroy();
        return redirect()->route('sepet');


    }
    public function guncelle($rowId)
    {
        $validator =Validator::make(request()->all(),[
            'adet' => 'required|numeric|between: 0.5'
        ]);

        if ($validator->fails()){
            session()->flash('mesaj_tur','danger');
            session()->flash('mesaj','Adet değeri en az 1 en fazla 5 olabilir');

            return response()->json(['success'=>false]);
        }

        if (auth()->check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowId);
            if (request('adet') == 0)
                SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
            else
                SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)
                    ->update(['adet'=>request('adet')]);

        }

        Cart::update($rowId,request('adet'));
        session()->flash('mesaj','adet bilgisi güncellendi');

        return response()->json(['success'=>true]);
    }
}
