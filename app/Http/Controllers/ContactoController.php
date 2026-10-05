<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactoController extends Controller
{
    public function index(Request $request)
    {
        $contactos = Contacto::query()
            ->when($request->filled('buscar'), function ($query) use ($request) {
                $buscar = trim($request->string('buscar')->toString());

                $query->where('nombre', 'like', "%{$buscar}%");
            })
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->estado))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('contactos.index', compact('contactos'));
    }

    public function updateEstado(Request $request, Contacto $contacto)
    {
        $datos = $request->validate([
            'estado' => ['required', 'in:pendiente,respondido,archivado'],
        ]);

        $contacto->update($datos);

        return redirect()
            ->route('contactos.index', $request->only('buscar'))
            ->with('success', 'Estado del contacto actualizado correctamente.');
    }

    public function descargarArchivo(Contacto $contacto)
    {
        abort_unless($contacto->archivo, 404);

        return Storage::disk('local')->download($contacto->archivo);
    }
}