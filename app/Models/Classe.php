<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    protected $fillable =
        [
            'code',
            'nom'
        ];

    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }

    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);
    }
}
