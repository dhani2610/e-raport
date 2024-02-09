<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('cascade');
            $table->string('name');
            $table->string('nis')->unique()->nullable();
            $table->string('nisn')->unique()->nullable();
            $table->string('tempatlahir');
            $table->date('tanggallahir');
            $table->enum('jk', ['L', 'P']);
            $table->string('agama');
            $table->enum('statusdalamkeluarga', ['AK','AA','AT'])->nullable();
            $table->bigInteger('anak_ke')->nullable();
            $table->text('alamatsiswa')->nullable();
            $table->string('teleponsiswa')->nullable();
            $table->string('sekolahasal')->nullable();
            $table->string('diterimadikelas')->nullable();
            $table->date('diterimaditanggal')->nullable();
            $table->string('namaayah')->nullable();
            $table->string('pekerjaanayah')->nullable();
            $table->string('namaibu')->nullable();
            $table->string('pekerjaanibu')->nullable();
            $table->text('alamatortu')->nullable();
            $table->text('teleponortu')->nullable();
            $table->string('namawali')->nullable();
            $table->string('pekerjaanwali')->nullable();
            $table->text('alamatwali')->nullable();
            $table->text('teleponwali')->nullable();
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
        Schema::dropIfExists('siswas');
    }
};
