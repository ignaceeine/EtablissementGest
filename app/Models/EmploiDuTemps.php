<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    protected $fillable =
        [
            'date',
            'heureDebut',
            'heureFin',
            'classe_id',
            'professeur_id'
        ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }
}
