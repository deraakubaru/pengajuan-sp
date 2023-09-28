<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemesterPendeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_pendeks', function (Blueprint $table) {
            $table->id();
            $table->string('dosen_wali_id');
            $table->string('mahasiswa_id');
            $table->string('matakuliah_id');
            $table->tinyInteger('level')->default(0);
            $table->string('keterangan');
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
        Schema::dropIfExists('semester_pendeks');
    }
}
