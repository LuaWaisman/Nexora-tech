<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Panel') · Nexora Tech</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@php
    $esTecnico = auth()->user()->rol === 'tecnico';
    $inicio = $esTecnico ? '/tecnico' : '/solicitante';
    $lista = $esTecnico ? '/tecnico/solicitudes' : '/solicitante/solicitudes';
@endphp
<div class="app">
    <aside class="sidebar">
        <div class="brand">NEXORA TECH</div>
        <nav>
            <a class="nav-link {{ request()->is(ltrim($inicio, '/')) ? 'active' : '' }}" href="{{ $inicio }}">
                <x-icon name="home" :size="40" /> Inicio
            </a>
            <a class="nav-link {{ request()->is(ltrim($lista, '/') . '*', 'solicitudes/*') ? 'active' : '' }}" href="{{ $lista }}">
                <x-icon name="menu" :size="40" /> {{ $esTecnico ? 'Solicitudes' : 'Mis Solicitudes' }}
            </a>
            @unless($esTecnico)
                <a class="nav-link {{ request()->is('solicitante/nueva') ? 'active' : '' }}" href="/solicitante/nueva">
                    <x-icon name="plus" :size="40" /> Nueva solicitud
                </a>
            @endunless
            <a class="nav-link {{ request()->is('perfil*') ? 'active' : '' }}" href="/perfil">
                <x-icon name="user" :size="40" /> Mi perfil
            </a>
        </nav>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="nav-link"><x-icon name="logout" :size="40" /> Cerrar sesión</button>
        </form>
    </aside>
    <main class="content">
        @if(session('success'))
            <div class="alert ok">{{ session('success') }}</div>
        @endif
        @if($errors->any() && !request()->is('perfil*', 'solicitante/nueva'))
            <div class="alert err">{{ $errors->first() }}</div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
