<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\EmploiDuTemps;
use App\Models\Professeur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'une classe
        $classe = Classe::create([
            'code' => 'L3GLG1',
            'nom'  => 'Licence 3 Génie Logiciel',
        ]);

        // Création d'un professeur
        $professeur = Professeur::create([
            'prenom' => 'Abdoulaye',
            'nom'    => 'LY',
            'email'  => 'lyabdoulaye@example.com',
        ]);

        // Création d'un cours associé à la classe et au professeur
        $cours = Cours::create([
            'nom'           => 'DevOps',
            'classe_id'     => $classe->id,
            'professeur_id' => $professeur->id,
        ]);

        // Création d'un emploi du temps lié à la classe, au professeur et au cours
        EmploiDuTemps::create([
            'date'          => '2025-03-10',
            'heureDebut'    => '08:00:00',
            'heureFin'      => '10:00:00',
            'classe_id'     => $classe->id,
            'professeur_id' => $professeur->id,
            'cours_id'      => $cours->id,
        ]);
    }
}
