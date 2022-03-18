<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          //status -> 0 (dihapus), 1 (inactive), 2 (active), 3 (suspend)
          Schema::create('mitras', function (Blueprint $table) {
               $table->id();
               $table->string('brand');
               $table->string('nama_pengelola');
               $table->string('nama_perusahaan');
               $table->string('email');
               $table->string('handphone');
               $table->text('alamat')->nullable();
               $table->integer('saldo')->default(0);
               $table->ipAddress('server')->nullable();
               $table->string('webhook')->nullable();
               $table->text('token')->nullable();
               $table->enum('status', [0,1,2,3])->default(2);
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
        Schema::dropIfExists('mitras');
    }
}
