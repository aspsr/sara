<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TipoCentroVaccinale extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_centro_vaccinale')->insert([
        'tipo' => 'A',
        'descrizione' => 'Adulti',
    ]);

    DB::table('tipo_centro_vaccinale')->insert([
        'tipo' => 'P',
        'descrizione' => 'Pediatrico',
    ]);

    DB::table('tipo_centro_vaccinale')->insert([
        'tipo' => 'M',
        'descrizione' => 'Misto',
    ]);

    }
}
