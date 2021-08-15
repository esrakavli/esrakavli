<?php

namespace App\Http\Controllers;

use App\Models\sipariş;
use Illuminate\Http\Request;

class siparişController extends Controller
{
    public function index()
    {
        $siparişler = sipariş::with('sepet')

            ->orderByDesc('updated_at')
            ->get();

        return view('siparişler',compact('siparişler'));
    }
    public function detay($id)
    {
        $sipariş = sipariş::with('sepet.sepet_urunler.urun')->where('siparişs.id',$id)->firstOrFail();
        return view('sipariş',compact('sipariş'));
    }
}
