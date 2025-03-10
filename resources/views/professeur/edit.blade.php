@extends('layouts.master')
@section('title','Modification Prof')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="mb-0">Modification d'un Professeur</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('professeur.update') }}" method="POST">
                            @csrf
                            <input type="number" name="id" value="{{ $professeur->id }}" hidden>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $professeur->prenom }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ $professeur->nom }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $professeur->email }}" required>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
