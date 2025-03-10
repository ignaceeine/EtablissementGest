<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etudiant extends Model
{
    protected $fillable =
        [
            'prenom',
            'nom',
            'email',
            'classe_id'
        ];

    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }
}
