<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index(): View
    {
        $classes = Classe::all();
        return view('classe.index', compact('classes'));
    }

    public function create() : View
    {
        return view('classe.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => 'required',
            'nom' => 'required'
        ]);

        Classe::create($data);

        return redirect()->route('classe.index');
    }

    public function edit($id) : View
    {
        $classe = Classe::find($id);
        return view('classe.edit', compact('classe'));
    }

    public function update(Request $request): RedirectResponse
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

    public function destroy($id): RedirectResponse
    {
        $classe = Classe::find($id);
        $classe->delete();

        return redirect()->route('classe.index');
    }
}
