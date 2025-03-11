<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class InterfaceTest extends DuskTestCase
{
    /**
     * Vérifie que la page d'accueil s'affiche correctement.
     */
    public function testAffichagePageAccueil()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //->assertSee('Bienvenue') // Ajustez selon le texte attendu sur votre page d'accueil
                ->assertVisible('nav')
                ->assertVisible('footer')
                ->screenshot('accueil');
        });
    }

    /**
     * Vérifie que la page des classes affiche la liste des classes.
     */
    public function testAffichageListeClasses()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/classe')
                ->assertSee('Liste des Classes')
                ->assertVisible('table')
                ->screenshot('liste-classes');
        });
    }

    /**
     * Vérifie que la page des professeurs affiche la liste des professeurs.
     */
    public function testAffichageListeProfesseurs()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/professeur')
                ->assertSee('Liste des Professeurs')
                ->assertVisible('table')
                ->screenshot('liste-professeurs');
        });
    }

    /**
     * Vérifie que la page des étudiants affiche la liste des étudiants.
     */
    public function testAffichageListeEtudiants()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/etudiant')
                ->assertSee('Liste des Étudiants')
                ->assertVisible('table')
                ->screenshot('liste-etudiants');
        });
    }

    /**
     * Vérifie que la page des cours affiche la liste des cours.
     */
    public function testAffichageListeCours()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cours')
                ->assertSee('Liste des Cours')
                ->assertVisible('table')
                ->screenshot('liste-cours');
        });
    }

    /**
     * Vérifie que la page des emplois du temps affiche la liste des emplois du temps.
     */
    public function testAffichageListeEmploisDuTemps()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/emploiDuTemps')
                ->assertSee('Liste des Emplois du Temps')
                ->assertVisible('table')
                ->screenshot('liste-emplois-du-temps');
        });
    }
}
