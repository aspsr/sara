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
        Schema::create('medico_centro_vaccinale', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("patient_id");
            $table->unsignedBigInteger("centro_vaccinale_id");
            $table->boolean("abilitato")->default(true);
            $table->timestamps();

            $table->foreign("patient_id", "fk_patient_id_20240627")->references("id")->on("patients");
            $table->foreign("centro_vaccinale_id", "fk_centro_vaccinale_id_20240627")->references("id")->on("centro_vaccinale");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico_centro_vaccinale');
    }
};
