<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentriVaccinaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Augusta',
            'indirizzo' => 'P.O. Muscatello pad. C',
            'citta' => 'Augusta',
            'telefono' => '0931989381',
            'email' => 'augusta.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Avola',
            'indirizzo' => 'Piazza Crispi, 48',
            'citta' => 'Avola',
            'telefono' => '0931582524',
            'email' => 'avola.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Canicattini Bagni',
            'indirizzo' => 'Via Umberto, 391',
            'citta' => 'Canicattini Bagni',
            'telefono' => '0931484033',
            'email' => 'canicattini.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Carlentini e Francofonte',
            'indirizzo' => 'P.O. Lentini - Contrada Colle Roggio',
            'citta' => 'Carlentini e Francofonte',
            'telefono' => '095909980',
            'email' => 'carlentini.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Ferla',
            'indirizzo' => 'Via Garibaldi snc',
            'citta' => 'Ferla',
            'telefono' => '0931879090',
            'email' => 'ferla.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Floridia',
            'indirizzo' => 'Via De Amicis, 2',
            'citta' => 'Floridia',
            'telefono' => '0931989514',
            'email' => 'floridia.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Lentini',
            'indirizzo' => 'P.O. Lentini - Contrada Colle Roggio',
            'citta' => 'Lentini',
            'telefono' => '095909980',
            'email' => 'lentini.semp@sp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Melilli',
            'indirizzo' => 'Via Martiri di Via Fani snc',
            'citta' => 'Melilli',
            'telefono' => '0931989451',
            'email' => 'melilli.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Noto',
            'indirizzo' => 'Via Principe di Piemonte, 109',
            'citta' => 'Noto',
            'telefono' => '0931890711',
            'email' => 'noto.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Pachino',
            'indirizzo' => 'Viale Quasimodo snc	',
            'citta' => 'Pachino',
            'telefono' => '0931890811',
            'email' => 'pachino.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Palazzolo Acreide	',
            'indirizzo' => 'Via Madonna delle Grazie, 39',
            'citta' => 'Palazzolo Acreide',
            'telefono' => '0931989667',
            'email' => 'palazzolo.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Priolo Gargallo',
            'indirizzo' => 'Via Mostringiano, 26',
            'citta' => 'Priolo Gargallo	',
            'telefono' => '0931989602',
            'email' => 'priolo.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Rosolini',
            'indirizzo' => 'Via Cavaliere Domenico Marina 1	',
            'citta' => 'Rosolini',
            'telefono' => '0931890029',
            'email' => 'rosolini.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Siracusa (adulti)',
            'indirizzo' => 'EX ONP padiglione 2	',
            'citta' => 'Siracusa ',
            'telefono' => '0931484628',
            'email' => 'semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '1'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Siracusa (pediatrico)',
            'indirizzo' => 'EX ONP padiglione 2	',
            'citta' => 'Siracusa ',
            'telefono' => '0931484643',
            'email' => 'semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '2'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Solarino',
            'indirizzo' => 'Via Magenta, 155',
            'citta' => 'Solarino ',
            'telefono' => '0931922311',
            'email' => 'solarino.semp@asp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        DB::table('centro_vaccinale')->insert([
            'descrizione' => 'Sortino',
            'indirizzo' => 'Via Libertà, 125',
            'citta' => 'Sortino ',
            'telefono' => '0931989845',
            'email' => 'sortino.semp@sp.sr.it',
            'id_tipo_centro_vaccinale' => '3'
        ]);

        

       
    }
}
