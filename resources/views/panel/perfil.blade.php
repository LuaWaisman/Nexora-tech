@extends('layouts.app')
@section('title', 'Mi perfil')
@section('content')
@php $user = auth()->user(); @endphp
<a class="volver" href="{{ $user->rol === 'tecnico' ? '/tecnico' : '/solicitante' }}"><x-icon name="back" :size="40" /> volver</a>
<h1 class="titulo">Mi perfil</h1>
<p class="subtitulo">Gestiona tu información personal</p>

<div class="perfil">
    <section>
        <div class="avatar"><x-icon name="user" :size="120" /></div>
        <button type="button" class="p-btn" disabled title="Función opcional, todavía no disponible" style="margin-top:12px">Cambiar foto</button>

        <label class="p-lbl">Nombre Completo</label>
        <input class="p-input" type="text" value="{{ $user->name }}" readonly>
        <label class="p-lbl">Correo electrónico</label>
        <input class="p-input" type="text" value="{{ $user->email }}" readonly>
        <label class="p-lbl">Rol</label>
        <input class="p-input" type="text" value="{{ ucfirst($user->rol === 'tecnico' ? 'técnico' : $user->rol) }}" readonly style="font-weight:700">
    </section>

    <section>
        <h2>Cambiar contraseña</h2>
        <form method="POST" action="/perfil/password" novalidate>
            @csrf
            @method('PUT')
            <input class="p-input" style="margin-top:14px" type="password" name="current_password" placeholder="Contraseña actual" autocomplete="current-password">
            @error('current_password')<div class="err-txt">{{ $message }}</div>@enderror

            <input class="p-input" style="margin-top:14px" type="password" name="password" placeholder="Nueva contraseña" autocomplete="new-password">
            @error('password')<div class="err-txt">{{ $message }}</div>@enderror

            <input class="p-input" style="margin-top:14px" type="password" name="password_confirmation" placeholder="Confirmar nueva contraseña" autocomplete="new-password">

            <button type="submit" class="p-btn fuerte">Actualizar contraseña</button>
        </form>
    </section>
</div>
@endsection
