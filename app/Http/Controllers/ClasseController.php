<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view('classe.index', compact('classes'));
    }

    public function create()
    {
        return view('classe.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'nom' => 'required'
        ]);

        Classe::create($data);

        return redirect()->route('classe.index');
    }

    public function edit($id)
    {
        $classe = Classe::find($id);
        return view('classe.edit', compact('classe'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'code' => 'required',
            'nom' => 'required'
        ]);

        $classe = Classe::find($data['id']);
        $classe->update($data);

        return redirect()->route('classe.index');
    }

    public function destroy($id)
    {
        $classe = Classe::find($id);
        $classe->delete();

        return redirect()->route('classe.index');
    }
}
