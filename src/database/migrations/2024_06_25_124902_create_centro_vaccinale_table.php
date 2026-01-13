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
        Schema::create('centro_vaccinale', function (Blueprint $table) {
            $table->id();
            $table->text('descrizione');
            $table->string('indirizzo');
            $table->string('citta');
            $table->string('telefono');
            $table->string('email');
            $table->unsignedBigInteger('id_tipo_centro_vaccinale');
            $table->timestamps();

            $table->foreign("id_tipo_centro_vaccinale" , "id_tipo_centro_vaccinale_20240625")->on("tipo_centro_vaccinale")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_vaccinale');
    }
};
