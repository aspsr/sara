<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class VacciniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('vaccini')->insert([
            'descrizione' => 'Esavalente',
            'mese_inizio' => '3',
            'mese_fine' => '3',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Esavalente',
            'mese_inizio' => '5',
            'mese_fine' => '5',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Esavalente',
            'mese_inizio' => '11',
            'mese_fine' => '11',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Rotavirus',
            'mese_inizio' => '3',
            'mese_fine' => '5',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Pneumococco coniugato',
            'mese_inizio' => '3',
            'mese_fine' => '3',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Pneumococco coniugato',
            'mese_inizio' => '5',
            'mese_fine' => '5',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Pneumococco coniugato',
            'mese_inizio' => '11',
            'mese_fine' => '11',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Meningococco',
            'mese_inizio' => '2',
            'mese_fine' => '3',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Meningococco',
            'mese_inizio' => '5',
            'mese_fine' => '5',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Meningococco',
            'mese_inizio' => '18',
            'mese_fine' => '23',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Meningococco',
            'mese_inizio' => '144',
            'mese_fine' => '216',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Morbillo,Parotite,Rosolia,Varicella(MPRV)',
            'mese_inizio' => '13',
            'mese_fine' => '18',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Meningococco ACWY (Men ACWY)',
            'mese_inizio' => '13',
            'mese_fine' => '13',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Meningococco ACWY (Men ACWY)',
            'mese_inizio' => '12',
            'mese_fine' => '360',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Difterite, Tetano, Pertosse, Poliomielite (DTPa-IPV o dTpa-IPV)',
            'mese_inizio' => '72',
            'mese_fine' => '72',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Difterite, Tetano, Pertosse, Poliomielite (DTPa-IPV o dTpa-IPV)',
            'mese_inizio' => '180',
            'mese_fine' => '216',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Papillomavirus (HPV)',
            'mese_inizio' => '144',
            'mese_fine' => '720',
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Difterite, Tetano, Pertosse (dTpa) (+/- IPV)',
            'mese_inizio' => '228',
            'mese_fine' => null,
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Influenza (FLU)',
            'mese_inizio' => '11',
            'mese_fine' => null,
        ]);

        DB::table('vaccini')->insert([
            'descrizione' => 'Herpes Zoster, a virus vivo attenuato (ZVL) o Herpes Zoster, ricombinante adiuvato (RZV)',
            'mese_inizio' => '780',
            'mese_fine' => '900',
        ]);
        
        DB::table('vaccini')->insert([
            'descrizione' => 'Strategia sequenziale, con anti-pneumococcico coniugato (PCV) seguito da anti-pneumococcico polisaccaridico (PPV)',
            'mese_inizio' => '228',
            'mese_fine' => null,
        ]);
    }
}
