<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class sepet extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded=[];
    const DELETED_AT='silinme_tarihi';

    public function siparis(){

        return $this->hasOne('App\Models\sipariş');
    }

    public function sepet_urunler(){
        return $this->hasMany('App\Models\SepetUrun');
    }

    public function aktif_sepet_id()
    {
        $aktif_sepet = DB::table('sepets')
            ->leftJoin('siparişs','sepet_id','=','id')
            ->where('kullanici_id',auth()->id())
            ->whereRaw('siparişs id is null')
            ->orderByDesc('created_at')
            ->select('id')
            ->first();
         if (!is_null($aktif_sepet)) return $aktif_sepet->id;

    }

    public function sepet_urun_adet()
    {
        return DB::table('sepet_uruns')->where('sepet_id',$this->id)->sum('adet');
    }


}
