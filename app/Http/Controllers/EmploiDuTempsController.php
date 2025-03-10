<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\EmploiDuTemps;
use App\Models\Professeur;
use Illuminate\Http\Request;

class EmploiDuTempsController extends Controller
{
    public function index()
    {
        $emploiDuTemps = EmploiDuTemps::all();
        return view('emploiDuTemps.index', compact('emploiDuTemps'));
    }

    public function create()
    {
        $classes = Classe::all();
        $professeurs = Professeur::all();
        $cours = Cours::all();
        return view('emploiDuTemps.create', compact('classes', 'professeurs', 'cours'));
    }

    public function store(Request $request)
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

    public function edit($id)
    {
        $emploiDuTemps = EmploiDuTemps::find($id);
        $classes = Classe::all();
        $professeurs = Professeur::all();
        $cours = Cours::all();

        return view('emploiDuTemps.edit', compact('emploiDuTemps', 'classes', 'professeurs', 'cours'));
    }

    public function update(Request $request)
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

    public function destroy($id)
    {
        $edt = EmploiDuTemps::find($id);
        $edt->delete();

        return redirect()->route('emploiDuTemps.index');
    }
}
