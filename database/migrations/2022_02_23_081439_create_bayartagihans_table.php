<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayartagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //status -> 0 (dihapus), 1 (available)
        Schema::create('bayartagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id');
            $table->foreignId('tagihan_id');
            $table->integer('saldo_terpotong');
            $table->enum('status', [0,1])->default(1);
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
        Schema::dropIfExists('bayartagihans');
    }
}
