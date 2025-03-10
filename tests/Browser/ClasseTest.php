<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ClasseTest extends DuskTestCase
{
    public function test_affichage_liste_classes()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/classe')
                ->assertSee('Liste des Classes')
                ->assertSee('Ajouter une Classe')
                ->assertVisible('table');
        });
    }
}
