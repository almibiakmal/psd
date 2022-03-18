<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('pengguna'); // id sekolah atau id mitra
            $table->enum('tipe_pengguna', ['sekolah','mitra']);
            $table->enum('kategori', ['masuk','keluar']);
            $table->integer('jumlah');
            $table->integer('saldo_awal');
            $table->integer('saldo_akhir');
            $table->string('reference');
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
        Schema::dropIfExists('transaksis');
    }
}
