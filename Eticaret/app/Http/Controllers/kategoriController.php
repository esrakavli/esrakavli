<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index($slug_kategoriadi){
        $kategori =kategori::where('slug', $slug_kategoriadi)->firstorFail();
        $alt_kategoriler = kategori::where('ust_id',$kategori->id)->take(8)->get();
        $order = request('order');
        if ($order=='çoksatanlar')
        {
            $urunler = $kategori->urunler()->orderBy('updated_at','desc')->paginate(2);

        }
        elseif ($order == 'yeni')
        {
            $urunler = $kategori->urunler()->orderBy('updated_at','desc')->paginate(2);
        }
        else
        {
            $urunler = $kategori->urunler()->paginate(2);
        }


        return view('kategori',compact('kategori','alt_kategoriler','urunler'));
    }
}
