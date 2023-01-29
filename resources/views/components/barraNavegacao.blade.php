<nav class="navbar fixed-top navbar-expand-md navbar-light">
    <div class="container-fluid px-4 pt-3">
        <a class="navbar-brand" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('assets/img/logo.png') }}" class="img" id="logo-barra-navegacao"/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li><a class="nav-link border border-2 rounded-pill px-3 text-center border-color-teste1 my-1 my-md-none d-md-none" href="#"><i class="bi bi-speedometer"></i>&nbsp; Dashboard</a></li>
                <li><a class="nav-link border border-2 rounded-pill px-3 text-center border-color-teste1 my-1 my-md-none d-md-none" href="#"><i class="bi bi-card-image"></i>&nbsp;&nbsp; Fotos</a></li>
                <li class="nav-item dropdown" id="btn-usuario">
                    <a class="nav-link mt-0 dropdown-toggle border border-2 rounded-pill px-3 text-center border-color-teste1 my-1 my-md-none" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>&nbsp; {{ auth()->user()->nome }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Meu Perfil</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="d-none d-md-block">
    <nav class="sidebar bg-color-teste1">
        <ul class="nav flex-column">
            <li class="nav-item list border-bottom border-top {{ $menu == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link py-4" href="{{ route('dashboard.index') }}"><i class="bi bi-speedometer"></i>&nbsp;&nbsp; Dashboard</a>
            </li>
            <li class="nav-item list border-bottom">
                <a class="nav-link py-4 {{ $menu == 'fotos' ? 'active' : '' }}" href="{{ route('fotos.index') }}"><i class="bi bi-card-image"></i>&nbsp;&nbsp; Fotos</a>
            </li>
            <li class="nav-item list border-bottom">
                <a class="nav-link py-4" href="{{ route('usuario.index') }}"><i class="bi bi-person-circle"></i>&nbsp;&nbsp; Meu Perfil</a>
            </li>
            <li class="nav-item list border-bottom">
                <a class="nav-link py-4" href="{{ route('logout') }}"><i class="bi bi-door-open"></i>&nbsp;&nbsp; Sair</a>
            </li>
        </ul>
    </nav>
</div>