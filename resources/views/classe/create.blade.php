@extends('layouts.master')
@section('title','Création classe')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="mb-0">Créer une Nouvelle Classe</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('classe.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="form-label">Code de la classe</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="Entrez le code de la classe" required>
                            </div>

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom de la classe</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom de la classe" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Créer la Classe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
