<?php

namespace App\Models;

use App\Models\kategori;
use App\Models\UrunDetay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class urun extends Model
{
    use SoftDeletes;

    protected $guarded =[];
    const DELETED_AT='silinme_tarihi';
    //const CREATED_AT = 'oluşturma_tarihi';
    //const UPDATED_AT = 'güncelleme_tarihi';

    public function kategoriler()
    {
      return $this->belongsToMany('App\Models\kategori','kategori_uruns');
    }

    public function detay()
    {
        return $this->hasOne('App\Models\UrunDetay');
    }

}
