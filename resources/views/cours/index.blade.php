@extends('layouts.master')
@section('title','Cours')
@section('content')
    <div class="container mt-4">
        <!-- Entête avec titre et bouton d'ajout -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Liste des Cours</h1>
            <a href="{{ route('cours.create') }}" class="btn btn-primary">Ajouter un Cours</a>
        </div>

        <!-- Card contenant le tableau -->
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-secondary">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Classe</th>
                            <th scope="col">Professeur</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cours as $c)
                            <tr>
                                <td>{{ $c->nom }}</td>
                                <td>{{ $c->classe->code }}</td>
                                <td>{{ $c->professeur->prenom}} {{ $c->professeur->nom}}</td>
                                <td>
                                    <a href="{{ route('cours.edit', $c->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('cours.destroy', $c->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun cours trouvé.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
