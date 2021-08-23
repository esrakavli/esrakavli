<?php

namespace App\Http\Controllers;

use App\Models\urun;
use Illuminate\Http\Request;

class urunController extends Controller
{
    public function index($slug_urunadi)
    {
     $urun = urun::where('slug',$slug_urunadi)->firstOrFail();
    $kategoriler = $urun->kategoriler()->distinct()->get();

      return view('urun',compact('urun','kategoriler'));
    }
    public function ara(){
        $aranan =\request()->input('aranan');
        $urunler = urun::where('urun_adi','like',"%$aranan%")
            ->orWhere('aciklama','like',"%$aranan%")
            ->simplePaginate(2);

        \request()->flash();
        return view('arama',compact('urunler'));

    }
}
