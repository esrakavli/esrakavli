<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class kullanici_detay extends Model
{

   public $timestamps =false;
   protected $guarded = [];

   public function kullanici()
   {
      return $this->belongsTo('App/Models/kullanici');
   }


}
