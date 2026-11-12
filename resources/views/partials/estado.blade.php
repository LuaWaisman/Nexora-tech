@php
    $clase = match ($estado) {
        'Pendiente' => 'pendiente',
        'En proceso' => 'proceso',
        'Resuelta' => 'resuelta',
        default => 'pendiente',
    };
@endphp
<span class="badge {{ $clase }}">{{ $estado }}</span>
