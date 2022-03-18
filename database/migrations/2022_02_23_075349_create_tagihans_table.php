<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          //status -> 2 (lunas), 1 (belum lunas), 0 (dihapus)
          Schema::create('tagihans', function (Blueprint $table) {
               $table->id();
               $table->string('title');
               $table->foreignId('sekolah_id');
               $table->string('nis');
               $table->string('nama');
               $table->integer('biaya');
               $table->string('sekolah');
               $table->string('metode_pembayaran')->nullable();
               $table->enum('status', [0,1,2])->default(1);
               $table->dateTime('waktu_pelunasan')->nullable();
               $table->dateTime('created_at')->useCurrent();
               $table->dateTime('updated_at')->nullable();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihans');
    }
}
