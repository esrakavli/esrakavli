<?php

namespace Database\Seeders;

use App\Models\UrunDetay;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(kategoriTableSeeder::class);
       $this->call(urunTableSeeder::class);

    }
}
