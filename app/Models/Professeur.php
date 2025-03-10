<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    protected $fillable =
        [
            'prenom',
            'nom',
            'email',
        ];

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
}
