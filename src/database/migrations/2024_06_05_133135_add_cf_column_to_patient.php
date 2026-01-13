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
        Schema::table('patients', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('name');
            $table->string('surname')->after('id');
            $table->string('vaccination_center_id')->after('name')->nullable();
            $table->string('phone')->after('name')->nullable();
            $table->string('tax_id')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('tax_id');
            $table->dropColumn('phone');
            $table->dropColumn('vaccination_center_id');
            $table->dropColumn('birth_date');
            $table->dropColumn('surname');
        });
    }
};
