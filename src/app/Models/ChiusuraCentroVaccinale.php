<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiusuraCentroVaccinale extends Model
{
    use HasFactory;

    protected $table = "chiusura_cv";

    public $timestamps = false;

    protected $fillable = [
        'cv_id',
        'motivazione' ,
        'data_chiusura',
        'id_operatore',
    ];

}
