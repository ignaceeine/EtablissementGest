<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cours extends Model
{
    protected $fillable =
        [
            'nom',
            'classe_id',
            'professeur_id'
        ];

    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function professeur(): BelongsTo
    {
        return $this->belongsTo(Professeur::class);
    }
}
