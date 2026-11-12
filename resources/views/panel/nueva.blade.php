@extends('layouts.app')
@section('title', 'Nueva solicitud')
@section('content')
<a class="volver" href="/solicitante"><x-icon name="back" :size="40" /> volver</a>
<h1 class="titulo">Crear nueva solicitud</h1>
<p class="subtitulo">Describe tu problema para que podamos ayudarte.</p>

<form class="form" method="POST" action="/solicitudes" novalidate>
    @csrf
    <label for="asunto">Asunto:</label>
    <input class="campo" type="text" id="asunto" name="asunto" value="{{ old('asunto') }}" maxlength="150" required>
    @error('asunto')<div class="err-txt">{{ $message }}</div>@enderror

    <label for="tipo">Tipo de problema:</label>
    <select class="campo" id="tipo" name="tipo" required>
        <option value="" disabled {{ old('tipo') ? '' : 'selected' }}>Seleccioná una opción</option>
        @foreach(['Hardware', 'Software', 'Red', 'Otro'] as $t)
            <option value="{{ $t }}" {{ old('tipo') === $t ? 'selected' : '' }}>{{ $t }}</option>
        @endforeach
    </select>
    @error('tipo')<div class="err-txt">{{ $message }}</div>@enderror

    <label for="descripcion">Descripción:</label>
    <textarea class="campo" id="descripcion" name="descripcion" required>{{ old('descripcion') }}</textarea>
    @error('descripcion')<div class="err-txt">{{ $message }}</div>@enderror

    <button type="button" class="adjuntar" disabled title="Función opcional, todavía no disponible">
        <x-icon name="clip" :size="30" /> Adjuntar archivo (opcional) — próximamente
    </button>

    <button type="submit" class="btn-enviar">Enviar solicitud</button>
</form>
@endsection
