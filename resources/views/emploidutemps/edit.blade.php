@extends('layouts.master')
@section('title','Modification Emploi Du Temps')
@section('content')
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="mb-0">Modifier Emploi du Temps</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('emploiDuTemps.update') }}" method="POST">
                            @csrf
                            <input type="number" name="id" value="{{ $emploiDuTemps->id }}" hidden>
                            <!-- Sélection de la Classe -->
                            <div class="mb-3">
                                <label for="classe_id" class="form-label">Classe</label>
                                <select name="classe_id" id="classe_id" class="form-select" required>
                                    @foreach($classes as $c)
                                        <option value="{{ $c->id }}" @selected($c->id == $emploiDuTemps->classe->id)>{{ $c->code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sélection du Cours -->
                            <div class="mb-3">
                                <label for="cours_id" class="form-label">Cours</label>
                                <select name="cours_id" id="cours_id" class="form-select" required>
                                    <option value="" selected>Sélectionnez un cours...</option>
                                    @foreach($cours as $c)
                                        <option value="{{ $c->id }}" @selected($c->id == $emploiDuTemps->cours->id)>{{ $c->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sélection du Professeur -->
                            <div class="mb-3">
                                <label for="prof_id" class="form-label">Professeur</label>
                                <select name="professeur_id" id="prof_id" class="form-select" required>
                                    <option value="" selected>Sélectionnez un professeur...</option>
                                    @foreach($professeurs as $p)
                                        <option value="{{ $p->id }}" @selected($p->id == $emploiDuTemps->professeur->id)>{{ $p->prenom }} {{ $p->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date et horaires -->
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $emploiDuTemps->date }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="heure_debut" class="form-label">Heure de Début</label>
                                    <input type="time" name="heureDebut" id="heure_debut" class="form-control" value="{{ $emploiDuTemps->heureDebut }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="heure_fin" class="form-label">Heure de Fin</label>
                                    <input type="time" name="heureFin" id="heure_fin" class="form-control" value="{{ $emploiDuTemps->heureFin }}" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
