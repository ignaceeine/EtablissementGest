@extends('layouts.master')
@section('title','Modification Cours')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="mb-0">Modification {{ $cours->nom }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cours.update') }}" method="POST">
                            @csrf
                            <input type="number" name="id" value="{{ $cours->id }}" hidden>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $cours->nom }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="classe" class="form-label">Classe</label>
                                <select class="form-control" id="classe" name="classe_id">
                                    @foreach($classes as $c)
                                        <option value="{{ $c->id }}" @selected($c->id == $cours->classe->id)>{{ $c->code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="professeur" class="form-label">Professeur</label>
                                <select class="form-control" id="professeur" name="professeur_id">
                                    @foreach($professeurs as $p)
                                        <option value="{{ $p->id }}" @selected($p->id == $cours->classe->id)>{{ $p->prenom }} {{ $p->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
