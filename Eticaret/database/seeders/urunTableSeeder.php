<?php

namespace Database\Seeders;
use App\Models\urun;
use App\Models\urun_detay;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class urunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $faker = Factory::create();
        for ($i = 0; $i < 30; $i++) {

            $urun_adi = $faker->sentence(2);
            $urun = urun::create([
                'urun_adi' => $urun_adi,
                //'slug'=>str_slug($urun_adi),
                'slug' => Str::slug($urun_adi),
                'aciklama' => $faker->sentence(5),
                'fiyati' => 1,

            ]);

            $detay=$urun->detay()->create([
                'goster_slider'=>rand(0,1),
                'goster_gunun_firsati'=>rand(0,1),
                'goster_one_cikan'=>rand(0,1),
                'goster_cok_satan'=>rand(0,1),
                'goster_indirimli'=>rand(0,1),

            ]);


        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
