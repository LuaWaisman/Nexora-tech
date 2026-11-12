@extends('layouts.app')
@section('title', 'Detalle de solicitud')
@section('content')
@php
    $esTecnico = auth()->user()->rol === 'tecnico';
    $volver = $esTecnico ? '/tecnico/solicitudes' : '/solicitante/solicitudes';
@endphp
<a class="volver" href="{{ $volver }}"><x-icon name="back" :size="40" /> volver</a>

<div class="det-top">
    <h1 class="titulo">Detalle de solicitud #{{ str_pad($solicitud->id_solicitud, 3, '0', STR_PAD_LEFT) }}</h1>
    @include('partials.estado', ['estado' => $solicitud->estado])
</div>

<div class="det-card">
    <div class="izq">
        @include('partials.icono-tipo', ['tipo' => $solicitud->tipo, 'size' => 110])
        <div>
            <div class="asunto">{{ $solicitud->asunto }}</div>
            <div class="fecha">Creada: {{ $solicitud->fecha_creacion?->format('d/m/Y') }}</div>
        </div>
    </div>
    <div class="solic">
        <x-icon name="user" :size="64" />
        <div>Solicitante <b>{{ $solicitud->solicitante->name ?? 'Sin solicitante' }}</b></div>
    </div>
</div>

<div class="dato">
    <h3>Descripción:</h3>
    <p>{!! nl2br(e($solicitud->descripcion)) !!}</p>
    <h3>Tipo:</h3>
    <p>{{ $solicitud->tipo }}</p>
    <h3>Estado actual:</h3>
    <p>{{ $solicitud->estado }}</p>
</div>

@if($esTecnico)
    <form class="estado-form" method="POST" action="/solicitudes/{{ $solicitud->id_solicitud }}">
        @csrf
        @method('PATCH')
        <strong>Cambiar estado:</strong>
        <select name="estado">
            @foreach(['Pendiente', 'En proceso', 'Resuelta'] as $e)
                <option value="{{ $e }}" {{ $solicitud->estado === $e ? 'selected' : '' }}>{{ $e }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-enviar" style="margin:0">Actualizar estado</button>
    </form>
@endif
@endsection
