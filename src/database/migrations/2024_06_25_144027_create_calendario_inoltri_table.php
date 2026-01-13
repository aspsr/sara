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
        
            Schema::create('calendario_inoltri', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('vaccini_id');
                $table->integer('giorno_inoltro');
                $table->timestamps();
    
      
                $table->foreign("vaccini_id" , "vaccini_id_20240625")->on("vaccini")->references("id");
            });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario_inoltri');
    }
};
