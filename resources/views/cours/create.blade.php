@extends('layouts.master')
@section('title','Ajout Cours')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="mb-0">Ajout d'un Nouveau Cours</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cours.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir le nom" required>
                            </div>

                            <div class="mb-3">
                                <label for="classe" class="form-label">Classe</label>
                                <select class="form-control" id="classe" name="classe_id" required>
                                    <option value="" selected>Selectionner...</option>
                                    @foreach($classes as $c)
                                        <option value="{{ $c->id }}">{{ $c->code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="professeur" class="form-label">Professeur</label>
                                <select class="form-control" id="professeur" name="professeur_id" required>
                                    <option value="" selected>Selectionner...</option>
                                    @foreach($professeurs as $p)
                                        <option value="{{ $p->id }}">{{ $p->prenom }} {{ $p->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Ajouter le cours</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
