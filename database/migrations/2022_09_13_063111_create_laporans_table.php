<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('desa_id');
            $table->bigInteger('comodity_id');
            $table->string('luas_tanam');
            $table->string('tanam_hasil');
            $table->string('jumlah_produksi');
            $table->string('provitas');
            $table->string('harga_produsen');
            $table->string('harga_grosir');
            $table->string('harga_eceran');
            $table->boolean('is_verified')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
