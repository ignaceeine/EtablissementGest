@extends('layouts.master')
@section('title','Etudiants')
@section('content')
    <div class="container mt-4">
        <!-- Entête avec titre et bouton d'ajout -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Liste des Étudiants</h1>
            <a href="{{ route('etudiant.create') }}" class="btn btn-primary">Ajouter un Étudiant</a>
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
                            <th scope="col">Classe</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->prenom }}</td>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>{{ $etudiant->classe->code ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('etudiant.destroy', $etudiant->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun étudiant trouvé.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
