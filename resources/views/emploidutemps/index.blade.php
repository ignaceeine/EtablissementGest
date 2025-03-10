@extends('layouts.master')
@section('title','Emplois du temps')
@section('content')
    <div class="container mt-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-dark">Liste des Emplois du Temps</h1>
            <a href="{{ route('emploiDuTemps.create') }}" class="btn btn-success">
                Ajouter un emploi du temps
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-secondary">
                    <tr>
                        <th>Classe</th>
                        <th>Cours</th>
                        <th>Professeur</th>
                        <th>Date</th>
                        <th>Heure Début</th>
                        <th>Heure Fin</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($emploiDuTemps as $emploi)
                        <tr>
                            <td>{{ $emploi->classe->nom }}</td>
                            <td>{{ $emploi->cours->nom }}</td>
                            <td>{{ $emploi->professeur->prenom }} {{ $emploi->professeur->nom }}</td>
                            <td>{{ date('d/m/Y', strtotime($emploi->date)) }}</td>
                            <td>{{ date('H:i', strtotime($emploi->heureDebut)) }}</td>
                            <td>{{ date('H:i', strtotime($emploi->heureFin)) }}</td>
                            <td>
                                <a href="{{ route('emploiDuTemps.edit', $emploi->id) }}" class="btn btn-warning btn-sm">
                                    Modifier
                                </a>
                                <form action="{{ route('emploiDuTemps.destroy', $emploi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet emploi du temps ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if ($emploiDuTemps->isEmpty())
                    <p class="text-center text-muted">Aucun emploi du temps disponible.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
