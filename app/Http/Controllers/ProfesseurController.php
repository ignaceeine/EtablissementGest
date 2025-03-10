<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    public function index()
    {
        $professeurs = Professeur::all();
        return view('professeur.index', compact('professeurs'));
    }

    public function create()
    {
        return view('professeur.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required','email', 'unique:professeurs'],
        ]);

        Professeur::create($data);

        return redirect()->route('professeur.index');
    }

    public function edit($id)
    {
        $professeur = Professeur::find($id);
        return view('professeur.edit', compact('professeur'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => ['required'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required','email']
        ]);

        $prof = Professeur::find($data['id']);
        $prof->update($data);

        return redirect()->route('professeur.index');
    }

    public function destroy($id)
    {
        $prof = Professeur::find($id);
        $prof->delete();

        return redirect()->route('professeur.index');
    }
}
