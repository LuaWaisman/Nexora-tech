@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
@php
    $esTecnico = auth()->user()->rol === 'tecnico';
    $lista = $esTecnico ? '/tecnico/solicitudes' : '/solicitante/solicitudes';
@endphp
<h1 class="saludo">HOLA!</h1>
<p class="subtitulo">Bienvenido al sistema de soporte técnico, {{ auth()->user()->name }}.</p>

<div class="stats">
    <a class="stat total" href="{{ $lista }}">
        <x-icon name="menu" :size="64" />
        <span class="lbl">{{ $esTecnico ? 'Solicitudes' : 'Mis Solicitudes' }}</span>
        <span class="num">{{ $contadores['total'] }}</span>
    </a>
    <a class="stat resuelta" href="{{ $lista }}?estado=Resuelta">
        <x-icon name="check" :size="64" />
        <span class="lbl">Resueltas</span>
        <span class="num">{{ $contadores['resueltas'] }}</span>
    </a>
    <a class="stat proceso" href="{{ $lista }}?estado=En proceso">
        <x-icon name="clock" :size="64" />
        <span class="lbl">En proceso</span>
        <span class="num">{{ $contadores['proceso'] }}</span>
    </a>
    <a class="stat pendiente" href="{{ $lista }}?estado=Pendiente">
        <x-icon name="hourglass" :size="64" />
        <span class="lbl">Pendientes</span>
        <span class="num">{{ $contadores['pendientes'] }}</span>
    </a>
</div>

<h2 class="seccion">{{ $esTecnico ? 'Últimas solicitudes recibidas' : 'Tus últimas solicitudes' }}</h2>
<div class="lista">
    @forelse($solicitudes as $s)
        @include('partials.fila', ['s' => $s, 'mostrarSolicitante' => $esTecnico, 'conLink' => true])
    @empty
        <div class="vacio">
            Todavía no hay solicitudes.
            @unless($esTecnico) <a href="/solicitante/nueva"><strong>Creá la primera</strong></a> @endunless
        </div>
    @endforelse
</div>
@endsection
