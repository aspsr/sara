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
        Schema::create('chiusura_cv', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cv_id');
            $table->string('motivazione');
            $table->date('data_chiusura');
            $table->unsignedBigInteger('id_operatore');

           // $table->foreign("padre_id" , "fk_padre_id_20240620")->on ("patients")->references("id");

            $table->foreign("cv_id" , "fk_cv_id_20240729")->on ("centro_vaccinale")->references("id");
            $table->foreign("id_operatore" , "fk_id_operatore_20240729")->on ("patients")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chiusura_cv');
    }
};
