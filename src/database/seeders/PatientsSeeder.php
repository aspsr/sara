<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            'id' => 1,
            'surname' => 'Cascione',
            'name' => 'Claudia',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'claudia.cascione@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 2,
            'surname' => 'Cianchino',
            'name' => 'Barbara',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'barbara.cianchino@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 3,
            'surname' => 'Luciano',
            'name' => 'Sebastiano',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'sebastiano.luciano@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 4,
            'surname' => 'Sciacca',
            'name' => 'Gina Enza',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'gina.sciacca@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 5,
            'surname' => 'Fazio',
            'name' => 'Rossella',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'rossella.fazio@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 6,
            'surname' => 'Randazzo',
            'name' => 'Concetta',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'concetta.randazzo@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 7,
            'surname' => 'Vacante',
            'name' => 'Maurizio',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'maurizio.vacante@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 8,
            'surname' => 'Vigilanza',
            'name' => 'Anna',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'anna.vigilanza@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 9,
            'surname' => 'Patane',
            'name' => 'Giuseppina',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'giuseppina.patane@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 10,
            'surname' => 'Fucile',
            'name' => 'Matteo',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'matteo.fucile@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 11,
            'surname' => 'Cannarella',
            'name' => 'Daniela',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'daniela.cannarella@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);


        DB::table('patients')->insert([
            'id' => 12,
            'surname' => 'Spatola',
            'name' => 'Corrado',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'corrado.spatola@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);

        DB::table('patients')->insert([
            'id' => 13,
            'surname' => 'Contarino',
            'name' => 'Fabio Massimo',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'fabio.contarino@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);


        DB::table('patients')->insert([
            'id' => 14,
            'surname' => 'Ierna',
            'name' => 'Giuseppe',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'giuseppe.ierna@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);


        DB::table('patients')->insert([
            'id' => 15,
            'surname' => 'Giuffrida',
            'name' => 'Biagia',
            'tax_id' => '',
            'phone' => null,
            'vaccination_center_id' => null,
            'birth_date' => null,
            'email' => 'biagia.giuffrida@asp.sr.it',
            'health_insurance_card' => null,
            'email_verified_at' => null,
            'phone_verified_at' => null,
            'password' => null,
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null,
            'ruolo_id' => '2',
            'stato' => '1'
        ]);
    }
}
