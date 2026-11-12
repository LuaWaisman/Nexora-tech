<div class="fila">
    <div class="ico">@include('partials.icono-tipo', ['tipo' => $s->tipo, 'size' => 64])</div>
    <div>
        <div class="asunto">#{{ str_pad($s->id_solicitud, 3, '0', STR_PAD_LEFT) }} · {{ $s->asunto }}</div>
        <div class="meta">
            {{ $s->fecha_creacion?->format('d/m/Y') }}
            · <small>{{ $s->solicitante->name ?? 'Sin solicitante' }}</small>
            · <small>{{ $s->tipo }}</small>
        </div>
    </div>
    @include('partials.estado', ['estado' => $s->estado])
    @if(!empty($conLink))
        <a class="ver" href="/solicitudes/{{ $s->id_solicitud }}">ver detalle</a>
    @else
        <span></span>
    @endif
</div>
