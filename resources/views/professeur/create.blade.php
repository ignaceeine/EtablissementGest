@extends('layouts.master')
@section('title','Ajout Prof')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="mb-0">Ajout d'un Nouveau Professeur</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('professeur.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Saisir le prénom" required>
                            </div>

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir le nom" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Saisir l'adresse email" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Ajouter le Prof</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
