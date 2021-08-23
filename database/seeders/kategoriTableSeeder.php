<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('kategoris')->insertGetId(['kategori_adi'=>'elektronik','slug'=>'elektronik']);
        DB::table('kategoris')->insert(['kategori_adi'=>'Bilgisayar/tablet','slug'=>'bilgisayar-tablet','ust_id'=>$id]);
        DB::table('kategoris')->insert(['kategori_adi'=>'telefon','slug'=>'telefon','ust_id'=>$id]);
        DB::table('kategoris')->insert(['kategori_adi'=>'kamera','slug'=>'kamera','ust_id'=>$id]);
        $id = DB::table('kategoris')->insertGetId(['kategori_adi'=>'kitap','slug'=>'kitap']);
        DB::table('kategoris')->insert(['kategori_adi'=>'Edebiyat','slug'=>'edebiyat','ust_id'=>$id]);
        DB::table('kategoris')->insert(['kategori_adi'=>'Çocuk','slug'=>'çocuk','ust_id'=>$id]);
        DB::table('kategoris')->insert(['kategori_adi'=>'Polisiye','slug'=>'polisiye','ust_id'=>$id]);
        DB::table('kategoris')->insert(['kategori_adi'=>'dergi','slug'=>'dergi']);
        DB::table('kategoris')->insert(['kategori_adi'=>'mobilya','slug'=>'mobilya']);
        DB::table('kategoris')->insert(['kategori_adi'=>'dekorasyon','slug'=>'dekorasyon']);
        DB::table('kategoris')->insert(['kategori_adi'=>'kozmetik','slug'=>'kozmetik']);
        DB::table('kategoris')->insert(['kategori_adi'=>'kişisel bakım','slug'=>'kişisel bakım']);
        DB::table('kategoris')->insert(['kategori_adi'=>'giyim-moda','slug'=>'giyim-moda']);
        DB::table('kategoris')->insert(['kategori_adi'=>'anne-çocuk','slug'=>'anne-çocuk']);

    }
}
