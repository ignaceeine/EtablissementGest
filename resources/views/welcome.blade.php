@extends('layouts.master')
@section('title','Accueil')
@section('content')
    <!-- Section Hero -->
    <section class="hero d-flex align-items-center">
        <div class="hero-overlay"></div>
        <div class="container text-center hero-content">
            <h1 class="display-3">Bienvenue sur EtablissementGest</h1>
            <p class="lead">Votre solution tout-en-un</p>
        </div>
    </section>

    <!-- Section de présentation des modules -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Gestion des Classes</h5>
                            <p class="card-text">Organisez et suivez vos classes et étudiants facilement.</p>
                            <a href="#" class="btn btn-primary">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Gestion des Cours</h5>
                            <p class="card-text">Planifiez vos cours et affectez les professeurs adéquats.</p>
                            <a href="#" class="btn btn-primary">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Emplois du Temps</h5>
                            <p class="card-text">Visualisez et gérez les emplois du temps de vos établissements.</p>
                            <a href="#" class="btn btn-primary">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
