<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmploiDuTemps extends Model
{
    protected $fillable =
        [
            'date',
            'heureDebut',
            'heureFin',
            'classe_id',
            'cours_id',
            'professeur_id'
        ];

    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cours::class);
    }

    public function professeur(): BelongsTo
    {
        return $this->belongsTo(Professeur::class);
    }
}
