<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriUrunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_uruns', function (Blueprint $table) {

                $table->increments('id');
                $table->integer('kategori_id')->unsigned();
                $table->integer('urun_id')->unsigned();

                $table->foreign('kategori_id')->references('id')->on('kategoris');
                $table->foreign('urun_id')->references('id')->on('uruns');
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_uruns');
    }
}
