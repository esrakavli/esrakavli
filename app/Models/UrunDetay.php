<?php

namespace App\Models;
use App\Models\urun;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrunDetay extends Model
{
 protected $guarded=[];

 public function urun(){

    return  $this->belongsTo('App\Models\urun');
 }
}
