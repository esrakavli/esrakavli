<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKullanicisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {

        Schema::create('kullanicis', function (Blueprint $table) {

            $table->increments('id');
            $table->string('adsoyad',60);
            $table->string('email',150)->unique();
            $table->string('sifre',60);
            $table->string('aktivasyon_anahtari')->nullable();
            $table->boolean('aktif_mi')->default(0);
            $table->boolean('yonetici_mi')->default(0);
            $table->rememberToken();
            $table->timestamp('created_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kullanicis');
    }
}
