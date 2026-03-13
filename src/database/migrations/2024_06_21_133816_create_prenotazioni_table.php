<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prenotazioni', function (Blueprint $table) {
            $table->id();
            $table->integer('paziente_id');
            $table->date('data_vaccino');
            $table->integer('tipo_vaccino_id')->nullable();
            $table->integer('centro_vaccinale_id');
            $table->date('data_ultimo_inoltro_msg')->nullable();
            $table->tinyInteger('iniettato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prenotazioni');
    }
};
