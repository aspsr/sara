<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aperture extends Model
{
    use HasFactory;

    protected $table = "agenda";

    protected $fillable = [
        "id",
        "centro_vaccinale_id",
        "giorno",
        "orario_inizio",
        "orario_fine",
        "slot",
    ];

}
