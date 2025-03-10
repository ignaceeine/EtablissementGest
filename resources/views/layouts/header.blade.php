<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
        <a class="navbar-brand" href="#">EtablissementGest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Basculer la navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('classe.*') ? 'active' : '' }}" href="{{ route('classe.index') }}">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cours.*') ? 'active' : '' }}" href="{{ route('cours.index') }}">Cours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('etudiant.*') ? 'active' : '' }}" href="{{ route('etudiant.index') }}">Étudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('professeur.*') ? 'active' : '' }}" href="{{ route('professeur.index') }}">Professeurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Emplois du temps</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
