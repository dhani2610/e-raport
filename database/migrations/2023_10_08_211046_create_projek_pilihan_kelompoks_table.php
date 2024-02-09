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
        Schema::create('projek_pilihan_kelompoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_projek_id')->constrained('kelompok_projeks')->onDelete('cascade');
            $table->foreignId('projek_id')->constrained('projeks')->onDelete('cascade');
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
        Schema::dropIfExists('projek_pilihan_kelompoks');
    }
};
