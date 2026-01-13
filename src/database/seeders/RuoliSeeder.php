<?php

namespace Database\Seeders;

use App\Models\Ruolo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruolo::create(['nome' => 'paziente']);
        Ruolo::create(['nome' => 'medico']);
        Ruolo::create(['nome' => 'operatore']);
    }
}
