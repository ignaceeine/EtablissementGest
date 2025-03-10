<?php

namespace Tests\Feature;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\EmploiDuTemps;
use App\Models\Professeur;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EmploiDuTempsControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_affiche_tous_les_emplois_du_temps()
    {
        // Création des objets nécessaires
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com'
        ]);
        $cours = Cours::create([
            'nom' => 'Mathématiques',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id
        ]);

        // Création d'un emploi du temps
        $emploi = EmploiDuTemps::create([
            'date' => '2025-03-10',
            'heureDebut' => '08:00:00',
            'heureFin' => '10:00:00',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id,
            'cours_id' => $cours->id,
        ]);

        $response = $this->get(route('emploiDuTemps.index'));

        $response->assertStatus(200);
        $response->assertViewIs('emploiDuTemps.index');
        $response->assertViewHas('emploiDuTemps', function ($emplois) use ($emploi) {
            return $emplois->contains($emploi);
        });
    }

    public function test_create_affiche_le_formulaire_de_creation()
    {
        // Création de quelques enregistrements pour que les listes déroulantes soient alimentées
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com'
        ]);
        $cours = Cours::create([
            'nom' => 'Mathématiques',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id
        ]);

        $response = $this->get(route('emploiDuTemps.create'));

        $response->assertStatus(200);
        $response->assertViewIs('emploiDuTemps.create');
        $response->assertViewHasAll(['classes', 'professeurs', 'cours']);
    }

    public function test_store_cree_un_nouvel_emploi_du_temps_et_redirige_vers_index()
    {
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com'
        ]);
        $cours = Cours::create([
            'nom' => 'Mathématiques',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id
        ]);

        $data = [
            'date' => '2025-03-10',
            'heureDebut' => '08:00:00',
            'heureFin' => '10:00:00',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id,
            'cours_id' => $cours->id,
        ];

        $response = $this->post(route('emploiDuTemps.store'), $data);

        $response->assertRedirect(route('emploiDuTemps.index'));
        $this->assertDatabaseHas('emploi_du_temps', $data);
    }

    public function test_edit_affiche_le_formulaire_dedition_avec_les_donnees()
    {
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com'
        ]);
        $cours = Cours::create([
            'nom' => 'Mathématiques',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id
        ]);

        $emploi = EmploiDuTemps::create([
            'date' => '2025-03-10',
            'heureDebut' => '08:00:00',
            'heureFin' => '10:00:00',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id,
            'cours_id' => $cours->id,
        ]);

        $response = $this->get(route('emploiDuTemps.edit', $emploi->id));

        $response->assertStatus(200);
        $response->assertViewIs('emploiDuTemps.edit');
        $response->assertViewHasAll(['emploiDuTemps', 'classes', 'professeurs', 'cours']);
        $response->assertViewHas('emploiDuTemps', function ($edt) use ($emploi) {
            return $edt->id === $emploi->id;
        });
    }

    public function test_update_modifie_un_emploi_du_temps_et_redirige_vers_index()
    {
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com'
        ]);
        $cours = Cours::create([
            'nom' => 'Mathématiques',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id
        ]);

        $emploi = EmploiDuTemps::create([
            'date' => '2025-03-10',
            'heureDebut' => '08:00:00',
            'heureFin' => '10:00:00',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id,
            'cours_id' => $cours->id,
        ]);

        $updatedData = [
            'id' => $emploi->id,
            'date' => '2025-03-11',  // Date modifiée
            'heureDebut' => '09:00:00',
            'heureFin' => '11:00:00',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id,
            'cours_id' => $cours->id,
        ];

        $response = $this->post(route('emploiDuTemps.update'), $updatedData);

        $response->assertRedirect(route('emploiDuTemps.index'));
        $this->assertDatabaseHas('emploi_du_temps', [
            'id' => $emploi->id,
            'date' => '2025-03-11',
            'heureDebut' => '09:00:00',
            'heureFin' => '11:00:00',
        ]);
    }

    public function test_destroy_supprime_un_emploi_du_temps_et_redirige_vers_index()
    {
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'email' => 'john.doe@example.com'
        ]);
        $cours = Cours::create([
            'nom' => 'Mathématiques',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id
        ]);

        $emploi = EmploiDuTemps::create([
            'date' => '2025-03-10',
            'heureDebut' => '08:00:00',
            'heureFin' => '10:00:00',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id,
            'cours_id' => $cours->id,
        ]);

        $response = $this->delete(route('emploiDuTemps.destroy', $emploi->id));

        $response->assertRedirect(route('emploiDuTemps.index'));
        $this->assertDatabaseMissing('emploi_du_temps', ['id' => $emploi->id]);
    }
}
