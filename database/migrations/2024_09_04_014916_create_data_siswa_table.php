<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis', 20)->unique();
            $table->string('kelas', 10);
            $table->string('jurusan', 50)->nullable();
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 10);
            $table->string('alamat')->nullable();
            $table->string('no_telepon', 15)->nullable();
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
        Schema::dropIfExists('data_siswa');
    }
}
