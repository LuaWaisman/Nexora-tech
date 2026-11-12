<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    // Mostrar las solicitudes según el rol del usuario
    public function index()
    {
        if (Auth::user()->rol === 'tecnico') {
            $solicitudes = Solicitud::with('solicitante')->get();
        } else {
            $solicitudes = Solicitud::where(
                'id_solicitante',
                Auth::id()
            )->get();
        }

        return view('solicitudes.index', compact('solicitudes'));
    }

    // Guardar una nueva solicitud
    public function store(Request $request)
    {
        $datos = $request->validate([
            'asunto' => ['required', 'string', 'max:150'],
            'descripcion' => ['required', 'string'],
            'tipo' => ['required', 'string', 'max:100'],
        ]);

        Solicitud::create([
            'id_solicitante' => Auth::id(),
            'asunto' => $datos['asunto'],
            'descripcion' => $datos['descripcion'],
            'tipo' => $datos['tipo'],
            'estado' => 'Pendiente',
        ]);

        return redirect('/solicitante')
            ->with('success', 'Solicitud creada correctamente.');
    }

    // Mostrar los detalles de una solicitud
    public function show($id)
    {
        $solicitud = Solicitud::with('solicitante')
            ->findOrFail($id);

        if (
            Auth::user()->rol === 'solicitante' &&
            $solicitud->id_solicitante !== Auth::id()
        ) {
            abort(403);
        }

        return view('solicitudes.show', compact('solicitud'));
    }

    // Actualizar el estado de una solicitud
    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $datos = $request->validate([
            'estado' => [
                'required',
                'in:Pendiente,En proceso,Resuelta'
            ],
        ]);

        $solicitud->update([
            'estado' => $datos['estado'],
        ]);

        return back()->with(
            'success',
            'Estado actualizado correctamente.'
        );
    }
}