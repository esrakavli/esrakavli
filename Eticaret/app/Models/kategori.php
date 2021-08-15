<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategori extends Model
{
    use SoftDeletes;
    public $timestamps =false;
    protected $guarded =[];

    const DELETED_AT = 'silinme_tarihi';

   public function urunler()
   {
       return $this->belongsToMany('App\Models\urun','kategori_uruns');
   }
   public function ust_kategori(){
      return $this->belongsTo('App\Models\kategori','ust_id')->withDefault([
          'kategori_adi'=>'Ana Kategori'
      ]);
   }

}
