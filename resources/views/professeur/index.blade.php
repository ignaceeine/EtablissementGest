@extends('layouts.master')
@section('title','Professeurs')
@section('content')
    <div class="container mt-4">
        <!-- Entête de la page avec titre et bouton d'ajout -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Liste des Professeurs</h1>
            <a href="{{ route('professeur.create') }}" class="btn btn-primary">Ajouter un Professeur</a>
        </div>

        <!-- Card contenant le tableau -->
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-secondary">
                        <tr>
                            <th scope="col">Prénom</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($professeurs as $prof)
                            <tr>
                                <td>{{ $prof->prenom }}</td>
                                <td>{{ $prof->nom }}</td>
                                <td>{{ $prof->email }}</td>
                                <td>
                                    <a href="{{ route('professeur.edit', $prof->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('professeur.destroy', $prof->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun professeur trouvé.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
