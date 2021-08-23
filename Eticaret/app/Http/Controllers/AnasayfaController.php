<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
  public function index(){

      $kategoriler =kategori::whereRaw('ust_id is null')->take(8)->get();
      $urunler_slider = UrunDetay::with('urun')->where('goster_slider',1)->take(5)->get();
      $urun_gunun_firsati = urun::query()->inRandomOrder()->first();

      return view('anasayfa',compact('kategoriler','urunler_slider','urun_gunun_firsati'));
  }
}
