<?php

namespace Tests\Feature;

use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EtudiantControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function index_affiche_tous_les_etudiants()
    {
        // Création d'une classe pour rattacher les étudiants
        $classe = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe 1'
        ]);

        // Création de quelques étudiants
        $etudiant1 = Etudiant::create([
            'nom'       => 'Doe',
            'prenom'    => 'John',
            'email'     => 'john.doe@example.com',
            'classe_id' => $classe->id,
        ]);
        $etudiant2 = Etudiant::create([
            'nom'       => 'Smith',
            'prenom'    => 'Jane',
            'email'     => 'jane.smith@example.com',
            'classe_id' => $classe->id,
        ]);

        // Appel de la route index
        $response = $this->get(route('etudiant.index'));

        // Vérifications : statut 200, vue attendue et présence des étudiants
        $response->assertStatus(200);
        $response->assertViewIs('etudiant.index');
        $response->assertViewHas('etudiants', function ($etudiants) use ($etudiant1, $etudiant2) {
            return $etudiants->contains($etudiant1) && $etudiants->contains($etudiant2);
        });
    }

    #[Test]
    public function create_affiche_le_formulaire_de_creation_avec_les_classes()
    {
        // Création de quelques classes
        $classe1 = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe 1'
        ]);
        $classe2 = Classe::create([
            'code' => 'CL002',
            'nom'  => 'Classe 2'
        ]);

        // Appel de la route create
        $response = $this->get(route('etudiant.create'));

        // Vérifications : statut 200, vue attendue et présence des classes dans la vue
        $response->assertStatus(200);
        $response->assertViewIs('etudiant.create');
        $response->assertViewHas('classes', function ($classes) use ($classe1, $classe2) {
            return $classes->contains($classe1) && $classes->contains($classe2);
        });
    }

    #[Test]
    public function store_cree_un_nouvel_etudiant_et_redirige_vers_index()
    {
        // Création d'une classe pour rattacher l'étudiant
        $classe = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe 1'
        ]);

        // Données de test pour la création d'un étudiant
        $data = [
            'nom'       => 'Doe',
            'prenom'    => 'John',
            'email'     => 'john.doe@example.com',
            'classe_id' => $classe->id,
        ];

        // Appel de la route store
        $response = $this->post(route('etudiant.store'), $data);

        // Vérification de la redirection et présence de l'étudiant en base
        $response->assertRedirect(route('etudiant.index'));
        $this->assertDatabaseHas('etudiants', $data);
    }

    #[Test]
    public function edit_affiche_le_formulaire_dedition_avec_l_etudiant_et_les_classes()
    {
        // Création d'une classe et d'un étudiant
        $classe = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe 1'
        ]);

        $etudiant = Etudiant::create([
            'nom'       => 'Doe',
            'prenom'    => 'John',
            'email'     => 'john.doe@example.com',
            'classe_id' => $classe->id,
        ]);

        // Appel de la route edit
        $response = $this->get(route('etudiant.edit', $etudiant->id));

        // Vérifications : statut 200, vue attendue et présence de l'étudiant et des classes dans la vue
        $response->assertStatus(200);
        $response->assertViewIs('etudiant.edit');
        $response->assertViewHasAll(['etudiant', 'classes']);
        $response->assertViewHas('etudiant', function ($etudiantView) use ($etudiant) {
            return $etudiantView->id === $etudiant->id;
        });
    }

    #[Test]
    public function update_modifie_un_etudiant_et_redirige_vers_index()
    {
        // Création d'une classe et d'un étudiant à mettre à jour
        $classe = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe 1'
        ]);

        $etudiant = Etudiant::create([
            'nom'       => 'Doe',
            'prenom'    => 'John',
            'email'     => 'john.doe@example.com',
            'classe_id' => $classe->id,
        ]);

        // Données de mise à jour
        $updatedData = [
            'id'        => $etudiant->id,
            'nom'       => 'Smith',
            'prenom'    => 'Jane',
            'email'     => 'jane.smith@example.com',
            'classe_id' => $classe->id,
        ];

        // Appel de la route update (via POST dans cet exemple)
        $response = $this->post(route('etudiant.update'), $updatedData);

        // Vérifications : redirection et mise à jour en base
        $response->assertRedirect(route('etudiant.index'));
        $this->assertDatabaseHas('etudiants', [
            'id'        => $etudiant->id,
            'nom'       => 'Smith',
            'prenom'    => 'Jane',
            'email'     => 'jane.smith@example.com',
            'classe_id' => $classe->id,
        ]);
    }

    #[Test]
    public function destroy_supprime_l_etudiant_et_redirige_vers_index()
    {
        // Création d'une classe et d'un étudiant à supprimer
        $classe = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe 1'
        ]);

        $etudiant = Etudiant::create([
            'nom'       => 'Doe',
            'prenom'    => 'John',
            'email'     => 'john.doe@example.com',
            'classe_id' => $classe->id,
        ]);

        // Appel de la route destroy
        $response = $this->delete(route('etudiant.destroy', $etudiant->id));

        // Vérification de la redirection et de la suppression en base
        $response->assertRedirect(route('etudiant.index'));
        $this->assertDatabaseMissing('etudiants', ['id' => $etudiant->id]);
    }
}
