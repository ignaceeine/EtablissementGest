@extends('layouts.master')
@section('title','Modification classe')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="mb-0">Modifier {{$classe->code}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('classe.update') }}" method="POST">
                            @csrf
                            <input type="number" name="id" id="" value="{{ $classe->id }}" hidden>
                            <div class="mb-3">
                                <label for="code" class="form-label">Code de la classe</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="Entrez le code de la classe" value="{{ $classe->code }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom de la classe</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom de la classe" value="{{ $classe->nom }}" required>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
