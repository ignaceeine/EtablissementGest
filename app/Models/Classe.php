<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable =
        [
            'code',
            'nom'
        ];

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
