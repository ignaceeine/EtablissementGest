@extends('layouts.master')
@section('title','Classes')
@section('content')
    <div class="container mt-4">
        <!-- Titre et bouton Ajouter -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Liste des Classes</h1>
            <a href="{{ route('classe.create') }}" class="btn btn-primary">Ajouter une Classe</a>
        </div>

        <!-- Card contenant le tableau -->
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Nom de la Classe</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($classes as $classe)
                            <tr>
                                <th scope="row">{{ $classe->code }}</th>
                                <td>{{ $classe->nom }}</td>
                                <td>
                                    <a href="{{ route('classe.edit', $classe->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('classe.destroy', $classe->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Aucune classe trouvée.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
