<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SepetUrun extends Model
{
    use SoftDeletes;

    protected $guarded=[];
    const DELETED_AT='silinme_tarihi';


    public function  urun()
    {
        return $this->belongsTo('App\Models\urun');
    }

}
