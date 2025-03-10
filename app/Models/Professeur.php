<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Professeur extends Model
{
    protected $fillable =
        [
            'prenom',
            'nom',
            'email',
        ];

    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }
}
