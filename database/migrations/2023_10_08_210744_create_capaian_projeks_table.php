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
        Schema::create('capaian_projeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projek_id')->constrained('projeks')->onDelete('cascade');
            $table->foreignId('capaian_akhir_id')->constrained('capaian_akhirs')->onDelete('cascade');
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
        Schema::dropIfExists('capaian_projeks');
    }
};
