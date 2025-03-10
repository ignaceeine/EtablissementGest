<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('etudiant.index', compact('etudiants'));
    }

    public function create()
    {
        $classes = Classe::all();
        return view('etudiant.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required','email','unique:etudiants'],
            'classe_id' => ['required']
        ]);

        Etudiant::create($data);

        return redirect()->route('etudiant.index');
    }

    public function edit($id)
    {
        $etudiant = Etudiant::find($id);
        $classes = Classe::all();
        return view('etudiant.edit', compact('etudiant', 'classes'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => ['required'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required','email'],
            'classe_id' => ['required']
        ]);

        $etudiant = Etudiant::find($data['id']);
        $etudiant->update($data);

        return redirect()->route('etudiant.index');
    }

    public function destroy($id)
    {
        $etudiant = Etudiant::find($id);
        $etudiant->delete();

        return redirect()->route('etudiant.index');
    }
}
