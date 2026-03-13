<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoCentroVaccinale extends Model
{
    use HasFactory;

    protected $table = "medico_centro_vaccinale";

    protected $fillable = [
        "patient_id",
        "centro_vaccinale_id",
        "abilitato",
    ];

    // definisco la relazione con il centro vaccinale
    public function centroVaccinale()
    {
        return $this->belongsTo(CentroVaccinale::class, 'centro_vaccinale_id');
    }


    public function getCentroVaccinale($medicoId)
    {
        // Recupera i centri vaccinali per i medici  abilitati
        return $this->where('abilitato', true)
                    ->where('patient_id', $medicoId)
                    ->with('centroVaccinale')
                    ->get();
    }
}
