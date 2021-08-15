<?php

use Illuminate\Support\Facades\Route;

//yönetim(admin)
Route::group(['prefix'=>'yonetim','namespace'=>'Yonetim'],function(){
    Route::redirect('/','yonetim/oturumac');

    Route::match(['get','post'],'/oturumac','kullanıcıController@oturumac')->name('yonetim.oturumac');
    Route::get('/oturumukapat','kullanıcıController@oturumukapat')->name('yonetim.oturumukapat');

    Route::group(['middleware'=>'admin'],function (){
        Route::get('/anasayfa','AnasayfaController@index')->name('yonetim.anasayfa');


        Route::group(['prefix'=>'kullanici'],function (){
          Route::match(['get','post'],'/','kullanıcıController@index')->name('yonetim.kullanici');
          Route::get('/yeni','kullanıcıController@form')->name('yonetim.kullanici.yeni');
          Route::get('/duzenle/{id}','kullanıcıController@form')->name('yonetim.kullanici.duzenle');
          Route::post('/kaydet/{id?}','kullanıcıController@kaydet')->name('yonetim.kullanici.kaydet');
          Route::get('/sil/{id}','kullanıcıController@sil')->name('yonetim.kullanici.sil');
        });

        Route::group(['prefix'=>'kategori'],function (){
            Route::match(['get','post'],'/','kategoriController@index')->name('yonetim.kategori');
            Route::get('/yeni','kategoriController@form')->name('yonetim.kategori.yeni');
            Route::get('/duzenle/{id}','kategoriController@form')->name('yonetim.kategori.duzenle');
            Route::post('/kaydet/{id?}','kategoriController@kaydet')->name('yonetim.kategori.kaydet');
            Route::get('/sil/{id}','kategoriController@sil')->name('yonetim.kategori.sil');
        });

    });


});


//anasayfa
Route::get('/','AnasayfaController@index')->name('anasayfa');

Route::get('/kategori/{slug_kategoriadi}','kategoriController@index')->name('kategori');

Route::get('/urun/{slug_urunadi}','urunController@index')->name('urun');
Route::post('/ara','urunController@ara')->name('urun_ara');
Route::get('/ara','urunController@ara')->name('urun_ara');

Route::group(['prefix'=>'sepet'],function(){
    Route::get('/','SepetController@index')->name('sepet');
    Route::post('/ekle','SepetController@ekle')->name('sepet.ekle');
    Route::delete('/kaldir/{rowid}','SepetController@kaldir')->name('sepet.kaldir');
    Route::delete('/boşalt','SepetController@boşalt')->name('sepet.boşalt');
    Route::patch('/guncellle/{rowid}','SepetController@guncelle')->name('sepet.guncelle');
});

Route::get('/ödeme','ödemeController@index')->name('ödeme');
Route::post('/ödeme','ödemeController@ödemeyap')->name('ödemeyap');


Route::group(['middleware'=>'auth'],function (){

    Route::get('/siparişler','siparişController@index')->name('siparişler');
    Route::get('/siparişler/{id}','siparişController@detay')->name('sipariş');

});

Route::group(['prefix'=>'kullanici'],function (){
    Route::get('/oturumac','kullanıcıController@giris_form')->name('kullanici.oturumaç');
    Route::post('/oturumac','kullanıcıController@giris');
    Route::get('/kaydol','kullanıcıController@kaydol_form')->name('kullanici.kaydol');
    Route::post('/kaydol','kullanıcıController@kaydol')->name('kullanici.kaydol');
    Route::get('/aktifleştir/{anahtar}','kullanıcıController@aktiflestir')->name('aktifleştir');
    Route::post('/oturumukapat','kullanıcıController@oturumukapat')->name('kullanici.oturumukapat');
});

Route::get('/test/mail',function (){
    $kullanici = \App\Models\kullanici::find(1);
    return new App\Mail\KullaniciKayitMail($kullanici);
});

Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
