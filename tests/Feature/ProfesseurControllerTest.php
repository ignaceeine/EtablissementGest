<?php

namespace Tests\Feature;

use App\Models\Professeur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfesseurControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function index_affiche_tous_les_professeurs()
    {
        // Création de quelques professeurs pour le test
        $prof1 = Professeur::create([
            'nom'    => 'Doe',
            'prenom' => 'John',
            'email'  => 'john.doe@example.com',
        ]);
        $prof2 = Professeur::create([
            'nom'    => 'Smith',
            'prenom' => 'Jane',
            'email'  => 'jane.smith@example.com',
        ]);

        // Appel de la route index
        $response = $this->get(route('professeur.index'));

        // Vérifications :
        $response->assertStatus(200);
        $response->assertViewIs('professeur.index');
        $response->assertViewHas('professeurs', function ($professeurs) use ($prof1, $prof2) {
            return $professeurs->contains($prof1) && $professeurs->contains($prof2);
        });
    }

    #[Test]
    public function create_affiche_le_formulaire_de_creation()
    {
        $response = $this->get(route('professeur.create'));

        $response->assertStatus(200);
        $response->assertViewIs('professeur.create');
    }

    #[Test]
    public function store_cree_un_nouveau_professeur_et_redirige_vers_index()
    {
        // Données de test pour créer un professeur
        $data = [
            'nom'    => 'Brown',
            'prenom' => 'Charlie',
            'email'  => 'charlie.brown@example.com',
        ];

        // Appel de la route store
        $response = $this->post(route('professeur.store'), $data);

        // Vérifications : redirection vers l'index et présence en base
        $response->assertRedirect(route('professeur.index'));
        $this->assertDatabaseHas('professeurs', $data);
    }

    #[Test]
    public function edit_affiche_le_formulaire_dedition_avec_le_professeur_selectionne()
    {
        // Création d'un professeur
        $professeur = Professeur::create([
            'nom'    => 'White',
            'prenom' => 'Walter',
            'email'  => 'walter.white@example.com',
        ]);

        // Appel de la route edit
        $response = $this->get(route('professeur.edit', $professeur->id));

        // Vérifications :
        $response->assertStatus(200);
        $response->assertViewIs('professeur.edit');
        $response->assertViewHas('professeur', function ($prof) use ($professeur) {
            return $prof->id === $professeur->id;
        });
    }

    #[Test]
    public function update_modifie_un_professeur_et_redirige_vers_index()
    {
        // Création d'un professeur à mettre à jour
        $professeur = Professeur::create([
            'nom'    => 'OldNom',
            'prenom' => 'OldPrenom',
            'email'  => 'old.email@example.com',
        ]);

        // Données de mise à jour
        $data = [
            'id'     => $professeur->id,
            'nom'    => 'NewNom',
            'prenom' => 'NewPrenom',
            'email'  => 'new.email@example.com',
        ];

        // Appel de la route update (via POST dans cet exemple)
        $response = $this->post(route('professeur.update'), $data);

        // Vérifications : redirection et mise à jour en base
        $response->assertRedirect(route('professeur.index'));
        $this->assertDatabaseHas('professeurs', [
            'id'     => $professeur->id,
            'nom'    => 'NewNom',
            'prenom' => 'NewPrenom',
            'email'  => 'new.email@example.com',
        ]);
    }

    #[Test]
    public function destroy_supprime_le_professeur_et_redirige_vers_index()
    {
        // Création d'un professeur à supprimer
        $professeur = Professeur::create([
            'nom'    => 'Delete',
            'prenom' => 'Me',
            'email'  => 'delete.me@example.com',
        ]);

        // Appel de la route destroy
        $response = $this->delete(route('professeur.destroy', $professeur->id));

        // Vérifications : redirection et absence de l'enregistrement en base
        $response->assertRedirect(route('professeur.index'));
        $this->assertDatabaseMissing('professeurs', ['id' => $professeur->id]);
    }
}
