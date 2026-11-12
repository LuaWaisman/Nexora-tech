<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    private const ESTADOS = ['Pendiente', 'En proceso', 'Resuelta'];

    // Consulta base: el técnico ve todo, el solicitante solo lo suyo.
    private function consulta()
    {
        $q = Solicitud::with('solicitante');

        if (Auth::user()->rol !== 'tecnico') {
            $q->where('id_solicitante', Auth::id());
        }

        return $q;
    }

    public function dashboard()
    {
        $contadores = [
            'total' => $this->consulta()->count(),
            'resueltas' => $this->consulta()->where('estado', 'Resuelta')->count(),
            'proceso' => $this->consulta()->where('estado', 'En proceso')->count(),
            'pendientes' => $this->consulta()->where('estado', 'Pendiente')->count(),
        ];

        $solicitudes = $this->consulta()
            ->orderByDesc('fecha_creacion')
            ->orderByDesc('id_solicitud')
            ->limit(5)
            ->get();

        return view('panel.dashboard', compact('contadores', 'solicitudes'));
    }

    public function lista(Request $request)
    {
        $esTecnico = Auth::user()->rol === 'tecnico';
        $buscar = trim((string) $request->query('q', ''));
        $estado = $request->query('estado');

        $q = $this->consulta();

        if ($buscar !== '') {
            $q->where(function ($w) use ($buscar, $esTecnico) {
                $w->where('asunto', 'like', '%' . $buscar . '%');

                if ($esTecnico) {
                    $w->orWhereHas('solicitante', function ($s) use ($buscar) {
                        $s->where('name', 'like', '%' . $buscar . '%');
                    });
                }
            });
        }

        if (in_array($estado, self::ESTADOS, true)) {
            $q->where('estado', $estado);
        } else {
            $estado = null;
        }

        $solicitudes = $q->orderByDesc('fecha_creacion')
            ->orderByDesc('id_solicitud')
            ->get();

        return view('panel.solicitudes', compact('solicitudes', 'buscar', 'estado'));
    }

    public function nueva()
    {
        return view('panel.nueva');
    }

    public function perfil()
    {
        return view('panel.perfil');
    }

    public function cambiarPassword(Request $request)
    {
        $datos = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8', 'different:current_password'],
        ]);

        $request->user()->update([
            'password' => $datos['password'],
        ]);

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
