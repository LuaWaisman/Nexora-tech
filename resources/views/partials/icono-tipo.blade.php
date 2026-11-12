@php
    $t = mb_strtolower($tipo ?? '');
    if (str_contains($t, 'red') || str_contains($t, 'wifi') || str_contains($t, 'internet')) {
        $icono = 'wifi';
    } elseif (str_contains($t, 'hardware') || str_contains($t, 'impresora') || str_contains($t, 'equipo')) {
        $icono = 'computer';
    } else {
        $icono = 'alert';
    }
@endphp
<x-icon :name="$icono" :size="$size ?? 64" />
