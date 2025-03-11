<?php


use App\Models\Classe;
use App\Models\Cours;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function il_peut_creer_une_classe()
    {
        // Création d'une instance de Classe
        $classe = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe de Test'
        ]);

        // Vérifie que l'objet retourné est bien une instance de Classe
        $this->assertInstanceOf(Classe::class, $classe);
        // Vérifie que la classe est enregistrée dans la base de données
        $this->assertDatabaseHas('classes', [
            'code' => 'CL001',
            'nom'  => 'Classe de Test'
        ]);
    }

    #[Test]
    public function il_peut_mettre_a_jour_une_classe()
    {
        // Création initiale d'une classe
        $classe = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe de Test'
        ]);

        // Mise à jour du nom de la classe
        $classe->update([
            'nom' => 'Classe Mise à Jour'
        ]);

        // Vérifie que la mise à jour est bien effective
        $this->assertEquals('Classe Mise à Jour', $classe->fresh()->nom);
        $this->assertDatabaseHas('classes', [
            'code' => 'CL001',
            'nom'  => 'Classe Mise à Jour'
        ]);
    }

    #[Test]
    public function il_peut_supprimer_une_classe()
    {
        // Création d'une classe à supprimer
        $classe = Classe::create([
            'code' => 'CL001',
            'nom'  => 'Classe de Test'
        ]);

        // Suppression de la classe
        $classe->delete();

        // Vérifie que la classe n'existe plus dans la base de données
        $this->assertDatabaseMissing('classes', [
            'code' => 'CL001',
            'nom'  => 'Classe de Test'
        ]);
    }
}
