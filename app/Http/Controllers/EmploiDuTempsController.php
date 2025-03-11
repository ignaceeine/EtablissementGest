<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\EmploiDuTemps;
use App\Models\Professeur;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmploiDuTempsController extends Controller
{
    public function index(): View
    {
        $emploiDuTemps = EmploiDuTemps::all();
        return view('emploidutemps.index', compact('emploiDuTemps'));
    }

    public function create(): View
    {
        $classes = Classe::all();
        $professeurs = Professeur::all();
        $cours = Cours::all();
        return view('emploidutemps.create', compact('classes', 'professeurs', 'cours'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'date' => 'required',
            'heureDebut' => 'required',
            'heureFin' => 'required',
            'classe_id' => 'required',
            'professeur_id' => 'required',
            'cours_id' => 'required'
        ]);

        EmploiDuTemps::create($data);

        return redirect()->route('emploiDuTemps.index');
    }

    public function edit($id): View
    {
        $emploiDuTemps = EmploiDuTemps::find($id);
        $classes = Classe::all();
        $professeurs = Professeur::all();
        $cours = Cours::all();

        return view('emploidutemps.edit', compact('emploiDuTemps', 'classes', 'professeurs', 'cours'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id' => 'required',
            'date' => 'required',
            'heureDebut' => 'required',
            'heureFin' => 'required',
            'classe_id' => 'required',
            'professeur_id' => 'required',
            'cours_id' => 'required'
        ]);
        $edt = EmploiDuTemps::find($data['id']);
        $edt->update($data);

        return redirect()->route('emploiDuTemps.index');
    }

    public function destroy($id): RedirectResponse
    {
        $edt = EmploiDuTemps::find($id);
        $edt->delete();

        return redirect()->route('emploiDuTemps.index');
    }
}
