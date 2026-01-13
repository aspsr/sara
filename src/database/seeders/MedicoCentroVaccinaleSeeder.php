<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicoCentroVaccinaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medico_centro_vaccinale')->insert([
            'id' => 1,
            'patient_id' => 3,
            'centro_vaccinale_id' => 2,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 2,
            'patient_id' => 1,
            'centro_vaccinale_id' => 2,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 3,
            'patient_id' => 2,
            'centro_vaccinale_id' => 2,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);


        DB::table('medico_centro_vaccinale')->insert([
            'id' => 4,
            'patient_id' => 4,
            'centro_vaccinale_id' => 1,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 5,
            'patient_id' => 5,
            'centro_vaccinale_id' => 1,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 6,
            'patient_id' => 6,
            'centro_vaccinale_id' => 3,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 7,
            'patient_id' => 6,
            'centro_vaccinale_id' => 5,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);



        DB::table('medico_centro_vaccinale')->insert([
            'id' => 8,
            'patient_id' => 7,
            'centro_vaccinale_id' => 4,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 9,
            'patient_id' => 8,
            'centro_vaccinale_id' => 7,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);
        
        DB::table('medico_centro_vaccinale')->insert([
            'id' => 10,
            'patient_id' => 5,
            'centro_vaccinale_id' => 8,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 11,
            'patient_id' => 1,
            'centro_vaccinale_id' => 9,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 12,
            'patient_id' => 2,
            'centro_vaccinale_id' => 9,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 13,
            'patient_id' => 3,
            'centro_vaccinale_id' => 9,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 14,
            'patient_id' => 9,
            'centro_vaccinale_id' => 10,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 15,
            'patient_id' => 2,
            'centro_vaccinale_id' => 10,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 16,
            'patient_id' => 3,
            'centro_vaccinale_id' => 10,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 17,
            'patient_id' => 6,
            'centro_vaccinale_id' => 11,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 18,
            'patient_id' => 10,
            'centro_vaccinale_id' => 12,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 19,
            'patient_id' => 9,
            'centro_vaccinale_id' => 13,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 20,
            'patient_id' => 2,
            'centro_vaccinale_id' => 13,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 21,
            'patient_id' => 3,
            'centro_vaccinale_id' => 13,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 22,
            'patient_id' => 11,
            'centro_vaccinale_id' => 14,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 23,
            'patient_id' => 12,
            'centro_vaccinale_id' => 14,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 24,
            'patient_id' => 13,
            'centro_vaccinale_id' => 14,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 25,
            'patient_id' => 13,
            'centro_vaccinale_id' => 15,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 26,
            'patient_id' => 10,
            'centro_vaccinale_id' => 15,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 27,
            'patient_id' => 12,
            'centro_vaccinale_id' => 15,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 28,
            'patient_id' => 13,
            'centro_vaccinale_id' => 16,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

        DB::table('medico_centro_vaccinale')->insert([
            'id' => 29,
            'patient_id' => 15,
            'centro_vaccinale_id' => 17,
            'abilitato' => 1,
            'created_at' => null,
            'updated_at' => null,
        ]);

    }
}
