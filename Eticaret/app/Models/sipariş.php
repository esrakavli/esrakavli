<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sipariş extends Model
{
    use SoftDeletes;
    //protected $table ="siparis";
    protected $fillable =[
        'sepet_id','siparis_tutari','banka','taksit_sayisi','durum',
        'adsoyad','adres','telefon','ceptelefonu'
    ];
    const DELETED_AT='silinme_tarihi';


    public function sepet()
    {
        return $this->belongsTo('App\Models\sepet');
    }
}
