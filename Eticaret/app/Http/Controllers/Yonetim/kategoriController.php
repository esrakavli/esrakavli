<?php

namespace App\Http\Controllers\Yonetim;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use App\Models\kullanici;
use App\Models\kullanici_detay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class kategoriController extends Controller
{
    public function index()
    {
        if(request()->filled('aranan'))
        {
            request()->flash();
            $aranan =request('aranan');
            $list =kategori::with('ust_kategori')->where('kategori_adi','like',"%$aranan%")
                ->orderByDesc('id')
                ->paginate(8)
                ->appends('aranan',$aranan);
        }
        else{
            $list = kategori::with('ust_kategori')->orderByDesc('id')->paginate(8);
        }
        $anakategoriler = kategori::whereRaw('ust_id is null')->get();

        return view('yonetim.kategori.index', compact('list'));
    }

    public function form($id = 0)
    {
        $entry = new kategori;
        if ($id > 0) {
            $entry = kategori::find($id);
        }

        $kategoriler =kategori::all();
        return view('yonetim.kategori.form', compact('entry','kategoriler'));
    }

    public function kaydet($id = 0)
    {

        $data = request()->only('kategori_adi', 'slug','ust_id');
        if (!request()->filled('slug')){
            $data['slug']=str_slug(request('kategori_adi'));
            request()->merge(['slug'=>$data['slug']]);
        }


        $this->validate(request(), [
            'kategori_adi' => 'required',
            'slug'=>(request('original_slug')!=request('slug') ?'unique:kategoris,slug':'')

        ]);

        if ($id > 0)
        {
            $entry = kategori::where('id', $id)->firstOrFail();
            $entry->update($data);

        }
        else
        {

            $entry =kategori::create($data);

        }
        return redirect()
            ->route('yonetim.kategori.duzenle',$entry->id)
            ->with('mesaj',($id>0 ? 'Guncellendi' : 'Kaydedildi'))
            ->with('mesaj_tur','success');
    }
    public function sil($id)
    {
        $kategori = kategori::find($id);
        $kategori->urunler()->detach();
        $kategori->delete();

        kategori::destroy($id);
        return redirect()
            ->route('yonetim.kategori')
            ->with('mesaj','kategori silindi')
            ->with('mesaj_tur','success');
    }
}
