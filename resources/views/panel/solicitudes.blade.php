@extends('layouts.app')
@section('title', 'Solicitudes')
@section('content')
@php
    $esTecnico = auth()->user()->rol === 'tecnico';
    $base = $esTecnico ? '/tecnico/solicitudes' : '/solicitante/solicitudes';
@endphp
<h1 class="titulo">{{ $esTecnico ? 'Solicitudes' : 'Mis Solicitudes' }}</h1>

<form class="buscador" method="GET" action="{{ $base }}">
    <input type="text" name="q" value="{{ $buscar }}" placeholder="{{ $esTecnico ? 'Buscar por asunto o solicitante' : 'Buscar por asunto' }}">
    @if($estado)<input type="hidden" name="estado" value="{{ $estado }}">@endif
    <button type="submit" aria-label="Buscar"><x-icon name="search" :size="38" /></button>
</form>

<div class="chips">
    <a class="chip {{ !$estado ? 'on' : '' }}" href="{{ $base }}{{ $buscar !== '' ? '?q=' . urlencode($buscar) : '' }}">Todas</a>
    @foreach(['Pendiente', 'En proceso', 'Resuelta'] as $e)
        <a class="chip {{ $estado === $e ? 'on' : '' }}" href="{{ $base }}?estado={{ urlencode($e) }}{{ $buscar !== '' ? '&q=' . urlencode($buscar) : '' }}">{{ $e }}</a>
    @endforeach
</div>

<div class="lista">
    @forelse($solicitudes as $s)
        @include('partials.fila', ['s' => $s, 'mostrarSolicitante' => $esTecnico, 'conLink' => true])
    @empty
        <div class="vacio">No se encontraron solicitudes.</div>
    @endforelse
</div>
@endsection
