<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\Professeur;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    public function index()
    {
        $cours = Cours::all();
        return view('cours.index', compact('cours'));
    }

    public function create()
    {
        $classes = Classe::all();
        $professeurs = Professeur::all();
        return view('cours.create', compact('classes', 'professeurs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required'],
            'classe_id' => ['required'],
            'professeur_id' => ['required']
        ]);

        Cours::create($data);

        return redirect()->route('cours.index');
    }

    public function edit($id)
    {
        $cours = Cours::find($id);
        $classes = Classe::all();
        $professeurs = Professeur::all();

        return view('cours.edit', compact('cours', 'classes', 'professeurs'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => ['required'],
            'nom' => ['required'],
            'classe_id' => ['required'],
            'professeur_id' => ['required']
        ]);

        $cours = Cours::find($data['id']);
        $cours->update($data);

        return redirect()->route('cours.index');
    }

    public function destroy($id)
    {
        $cours = Cours::find($id);
        $cours->delete();

        return redirect()->route('cours.index');
    }
}
