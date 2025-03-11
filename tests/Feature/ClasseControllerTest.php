<?php

namespace Tests\Feature;

use App\Models\Classe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ClasseControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function index_affiche_toutes_les_classes()
    {
        // Création de quelques classes pour le test
        $classe1 = Classe::create(['code' => 'C001', 'nom' => 'Classe 1']);
        $classe2 = Classe::create(['code' => 'C002', 'nom' => 'Classe 2']);

        // Appel de la route index
        $response = $this->get(route('classe.index'));

        // Vérifications :
        $response->assertStatus(200);
        $response->assertViewIs('classe.index');
        $response->assertViewHas('classes', function ($classes) use ($classe1, $classe2) {
            return $classes->contains($classe1) && $classes->contains($classe2);
        });
    }

    #[Test]
    public function create_affiche_le_formulaire_de_creation()
    {
        $response = $this->get(route('classe.create'));

        $response->assertStatus(200);
        $response->assertViewIs('classe.create');
    }

    #[Test]
    public function store_cree_une_nouvelle_classe_et_redirige_vers_index()
    {
        // Données de test pour créer une classe
        $data = [
            'code' => 'C003',
            'nom'  => 'Classe 3'
        ];

        // Appel de la route store
        $response = $this->post(route('classe.store'), $data);

        // Vérifications : redirection vers l'index et présence en base
        $response->assertRedirect(route('classe.index'));
        $this->assertDatabaseHas('classes', $data);
    }

    #[Test]
    public function edit_affiche_le_formulaire_dedition_avec_la_classe_selectionnee()
    {
        // Création d'une classe
        $classe = Classe::create(['code' => 'C004', 'nom' => 'Classe 4']);

        // Appel de la route edit
        $response = $this->get(route('classe.edit', $classe->id));

        // Vérifications :
        $response->assertStatus(200);
        $response->assertViewIs('classe.edit');
        $response->assertViewHas('classe', function ($viewClasse) use ($classe) {
            return $viewClasse->id === $classe->id;
        });
    }

    #[Test]
    public function update_modifie_une_classe_et_redirige_vers_index()
    {
        // Création d'une classe à mettre à jour
        $classe = Classe::create(['code' => 'C005', 'nom' => 'Classe 5']);

        // Données de mise à jour
        $updatedData = [
            'id'   => $classe->id,
            'code' => 'C005-Updated',
            'nom'  => 'Classe 5 Updated'
        ];

        // Appel de la route update (selon votre définition, ici on utilise POST)
        $response = $this->post(route('classe.update'), $updatedData);

        // Vérifications : redirection et mise à jour en base
        $response->assertRedirect(route('classe.index'));
        $this->assertDatabaseHas('classes', [
            'id'   => $classe->id,
            'code' => 'C005-Updated',
            'nom'  => 'Classe 5 Updated'
        ]);
    }

    #[Test]
    public function destroy_supprime_la_classe_et_redirige_vers_index()
    {
        // Création d'une classe à supprimer
        $classe = Classe::create(['code' => 'C006', 'nom' => 'Classe 6']);

        // Appel de la route destroy
        $response = $this->delete(route('classe.destroy', $classe->id));

        // Vérifications : redirection et absence de la classe en base
        $response->assertRedirect(route('classe.index'));
        $this->assertDatabaseMissing('classes', ['id' => $classe->id]);
    }
}
