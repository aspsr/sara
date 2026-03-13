<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroVaccinale extends Model
{
    use HasFactory;

    protected $table = "centro_vaccinale";

    protected $fillable = [
        "id",
        "descrizione",
        "indirizzo",
        "vitta",
        "telefono",
        "email",
        "id_tipo_centro_vaccinale",
    ];

    
}
