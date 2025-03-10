<?php

namespace Tests\Feature;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\Professeur;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CoursControllerTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function index_affiche_tous_les_cours()
    {
        // Création d'une classe et d'un professeur
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create(['nom' => 'Diatta', 'prenom' => 'Ignace', 'email' => 'ignace@example.com']);

        // Création de cours
        $cours1 = Cours::create(['nom' => 'Mathématiques', 'classe_id' => $classe->id, 'professeur_id' => $professeur->id]);
        $cours2 = Cours::create(['nom' => 'Physique', 'classe_id' => $classe->id, 'professeur_id' => $professeur->id]);

        // Appel de la route index
        $response = $this->get(route('cours.index'));

        // Vérifications
        $response->assertStatus(200);
        $response->assertViewIs('cours.index');
        $response->assertViewHas('cours', function ($cours) use ($cours1, $cours2) {
            return $cours->contains($cours1) && $cours->contains($cours2);
        });
    }

    #[Test]
    public function create_affiche_le_formulaire_de_creation_avec_les_classes_et_professeurs()
    {
        // Création de classes et professeurs
        $classe1 = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur1 = Professeur::create(['nom' => 'Touré', 'prenom' => 'Papa', 'email' => 'papa@example.com']);

        // Appel de la route create
        $response = $this->get(route('cours.create'));

        // Vérifications
        $response->assertStatus(200);
        $response->assertViewIs('cours.create');
        $response->assertViewHasAll(['classes', 'professeurs']);
    }

    #[Test]
    public function store_cree_un_nouveau_cours_et_redirige_vers_index()
    {
        // Création de données nécessaires
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create(['nom' => 'Diatta', 'prenom' => 'Ignace', 'email' => 'ignace@example.com']);

        // Données pour un nouveau cours
        $data = [
            'nom' => 'Histoire',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id,
        ];

        // Envoi du formulaire
        $response = $this->post(route('cours.store'), $data);

        // Vérifications
        $response->assertRedirect(route('cours.index'));
        $this->assertDatabaseHas('cours', $data);
    }

    #[Test]
    public function edit_affiche_le_formulaire_dedition_avec_le_cours_selectionne()
    {
        // Création des données nécessaires
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create(['nom' => 'Touré', 'prenom' => 'Papa', 'email' => 'papa@example.com']);
        $cours = Cours::create(['nom' => 'Science', 'classe_id' => $classe->id, 'professeur_id' => $professeur->id]);

        // Appel de la route edit
        $response = $this->get(route('cours.edit', $cours->id));

        // Vérifications
        $response->assertStatus(200);
        $response->assertViewIs('cours.edit');
        $response->assertViewHasAll(['cours', 'classes', 'professeurs']);
    }

    #[Test]
    public function update_modifie_un_cours_et_redirige_vers_index()
    {
        // Création des données nécessaires
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create(['nom' => 'Diatta', 'prenom' => 'Ignace', 'email' => 'ignace@example.com']);
        $cours = Cours::create(['nom' => 'Informatique', 'classe_id' => $classe->id, 'professeur_id' => $professeur->id]);

        // Données mises à jour
        $updatedData = [
            'id' => $cours->id,
            'nom' => 'Programmation',
            'classe_id' => $classe->id,
            'professeur_id' => $professeur->id,
        ];

        // Envoi du formulaire
        $response = $this->post(route('cours.update'), $updatedData);

        // Vérifications
        $response->assertRedirect(route('cours.index'));
        $this->assertDatabaseHas('cours', [
            'id' => $cours->id,
            'nom' => 'Programmation',
        ]);
    }

    #[Test]
    public function destroy_supprime_un_cours_et_redirige_vers_index()
    {
        // Création des données nécessaires
        $classe = Classe::create(['code' => 'CL001', 'nom' => 'Classe 1']);
        $professeur = Professeur::create(['nom' => 'Touré', 'prenom' => 'Papa', 'email' => 'papa@example.com']);
        $cours = Cours::create(['nom' => 'Économie', 'classe_id' => $classe->id, 'professeur_id' => $professeur->id]);

        // Suppression du cours
        $response = $this->delete(route('cours.destroy', $cours->id));

        // Vérifications
        $response->assertRedirect(route('cours.index'));
        $this->assertDatabaseMissing('cours', ['id' => $cours->id]);
    }
}
