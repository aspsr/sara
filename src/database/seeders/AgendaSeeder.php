<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '1',
            'giorno' => 'lunedi',
            'orario_inizio' => '8:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '1',
            'giorno' => 'martedi',
            'orario_inizio' => '14:30',
            'orario_fine' => '17:00',
            'slot' => '12',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '1',
            'giorno' => 'mercoledi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '1',
            'giorno' => 'giovedi',
            'orario_inizio' => '14:30',
            'orario_fine' => '17:00',
            'slot' => '12',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '1',
            'giorno' => 'venerdi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '2',
            'giorno' => 'lunedi',
            'orario_inizio' => '09:30',
            'orario_fine' => '13:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '2',
            'giorno' => 'martedi',
            'orario_inizio' => '09:00',
            'orario_fine' => '13:00',
            'slot' => '16',
        ]);
        
        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '2',
            'giorno' => 'giovedi',
            'orario_inizio' => '09:00',
            'orario_fine' => '13:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '2',
            'giorno' => 'venerdi',
            'orario_inizio' => '09:00',
            'orario_fine' => '13:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '3',
            'giorno' => 'mercoledi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '4',
            'giorno' => 'lunedi',
            'orario_inizio' => '09:00',
            'orario_fine' => '12:00',
            'slot' => '12',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '4',
            'giorno' => 'mercoledi',
            'orario_inizio' => '09:00',
            'orario_fine' => '12:00',
            'slot' => '12',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '4',
            'giorno' => 'giovedi',
            'orario_inizio' => '09:00',
            'orario_fine' => '12:00',
            'slot' => '12',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '4',
            'giorno' => 'venerdi',
            'orario_inizio' => '09:00',
            'orario_fine' => '12:00',
            'slot' => '12',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '5',
            'giorno' => 'venerdi',
            'orario_inizio' => '09:00',
            'orario_fine' => '13:00',
            'slot' => '16',
        ]);
        

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '6',
            'giorno' => 'martedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '6',
            'giorno' => 'mercoledi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '6',
            'giorno' => 'giovedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '6',
            'giorno' => 'giovedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '7',
            'giorno' => 'lunedi',
            'orario_inizio' => '09:00',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '7',
            'giorno' => 'martedi',
            'orario_inizio' => '09:00',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '7',
            'giorno' => 'martedi',
            'orario_inizio' => '16:00',
            'orario_fine' => '18:00',
            'slot' => '8',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '7',
            'giorno' => 'mercoledi',
            'orario_inizio' => '09:00',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '8',
            'giorno' => 'mercoledi',
            'orario_inizio' => '09:00',
            'orario_fine' => '12:00',
            'slot' => '12',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '9',
            'giorno' => 'lunedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '9',
            'giorno' => 'martedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '9',
            'giorno' => 'martedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '9',
            'giorno' => 'mercoledi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '9',
            'giorno' => 'giovedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '9',
            'giorno' => 'giovedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '9',
            'giorno' => 'venerdi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '10',
            'giorno' => 'lunedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '10',
            'giorno' => 'mercoledi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '10',
            'giorno' => 'venerdi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '11',
            'giorno' => 'lunedi',
            'orario_inizio' => '09:00',
            'orario_fine' => '13:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '11',
            'giorno' => 'giovedi',
            'orario_inizio' => '09:00',
            'orario_fine' => '13:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '11',
            'giorno' => 'venerdi',
            'orario_inizio' => '09:00',
            'orario_fine' => '13:00',
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '12',
            'giorno' => 'martedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '12',
            'giorno' => 'giovedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '12',
            'giorno' => 'venerdi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:00',
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '13',
            'giorno' => 'martedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '13',
            'giorno' => 'martedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '13',
            'giorno' => 'mercoledi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '13',
            'giorno' => 'giovedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '13',
            'giorno' => 'giovedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '14',
            'giorno' => 'lunedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '14',
            'giorno' => 'martedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '14',
            'giorno' => 'martedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '14',
            'giorno' => 'mercoledi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '14',
            'giorno' => 'giovedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        
        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '14',
            'giorno' => 'giovedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '14',
            'giorno' => 'venerdi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '15',
            'giorno' => 'lunedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '15',
            'giorno' => 'martedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '15',
            'giorno' => 'martedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '15',
            'giorno' => 'mercoledi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '15',
            'giorno' => 'giovedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '15',
            'giorno' => 'venerdi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:30',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '16',
            'giorno' => 'lunedi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:00',
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '16',
            'giorno' => 'martedi',
            'orario_inizio' => '15:00',
            'orario_fine' => '16:30',
            'slot' => '8',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '16',
            'giorno' => 'venerdi',
            'orario_inizio' => '08:30',
            'orario_fine' => '12:00' ,
            'slot' => '16',
        ]);


        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '17',
            'giorno' => 'martedi',
            'orario_inizio' => '08:00',
            'orario_fine' => '13:30' ,
            'slot' => '24',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '17',
            'giorno' => 'martedi',
            'orario_inizio' => '14:30',
            'orario_fine' => '17:00' ,
            'slot' => '12',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '17',
            'giorno' => 'mercoledi',
            'orario_inizio' => '10:00',
            'orario_fine' => '13:30' ,
            'slot' => '16',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '17',
            'giorno' => 'giovedi',
            'orario_inizio' => '08:00',
            'orario_fine' => '13:30' ,
            'slot' => '24',
        ]);

        DB::table('agenda')->insert([
            'centro_vaccinale_id' => '17',
            'giorno' => 'giovedi',
            'orario_inizio' => '14:30',
            'orario_fine' => '17:00' ,
            'slot' => '12',
        ]);


    }
}
