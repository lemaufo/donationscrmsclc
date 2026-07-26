<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CollaboratorRegistrationController extends Controller
{
    public function show(string $token): View
    {
        $campaign = Campaign::where('registration_token', $token)
            ->where('is_active', true)
            ->firstOrFail();

        return view('collaborator.register', compact('campaign'));
    }

    public function store(Request $request, string $token)
    {
        $campaign = Campaign::where('registration_token', $token)
            ->where('is_active', true)
            ->firstOrFail();

        // Verificar que la campaña está en rango de fechas
        if (!$campaign->isOpen()) {
            return view('collaborator.campaign-closed', compact('campaign'));
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:collaborators,email|max:255',
            'employee_id' => 'nullable|string|max:100',
            'department'  => 'nullable|string|max:100',
        ]);

        // Generar iniciales (3 letras: nombre + apellido1 + apellido2)
        $initials = $this->generateInitials($validated['name']);

        // Generar ref_code único
        do {
            $refCode = $initials . '-' . strtoupper(\Illuminate\Support\Str::random(4));
        } while (Collaborator::where('ref_code', $refCode)->exists());

        $collaborator = Collaborator::create([
            'campaign_id' => $campaign->id,
            'ref_code'    => $refCode,
            'initials'    => $initials,
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'employee_id' => $validated['employee_id'] ?? null,
            'department'  => $validated['department'] ?? null,
            'is_active'   => true,
        ]);

        return redirect()->route('collaborator.show', $collaborator->ref_code)
            ->with('welcome', true);
    }

    private function generateInitials(string $name): string
    {
        // Limpiar y separar palabras
        $words = array_filter(explode(' ', trim($name)));
        $words = array_values($words);

        // Partículas a ignorar
        $particles = ['de', 'del', 'la', 'las', 'los', 'y', 'e'];

        // Filtrar partículas
        $filtered = array_values(array_filter($words, function($w) use ($particles) {
            return !in_array(strtolower($w), $particles);
        }));

        $initials = '';

        if (count($filtered) >= 3) {
            // Nombre + Apellido1 + Apellido2
            $initials = strtoupper(
                substr($filtered[0], 0, 1) .
                substr($filtered[1], 0, 1) .
                substr($filtered[2], 0, 1)
            );
        } elseif (count($filtered) === 2) {
            // Nombre + Apellido (repetir última)
            $initials = strtoupper(
                substr($filtered[0], 0, 1) .
                substr($filtered[1], 0, 1) .
                substr($filtered[1], 0, 1)
            );
        } else {
            // Solo un nombre — tomar primeras 3 letras
            $initials = strtoupper(substr($filtered[0], 0, 3));
        }

        return $initials;
    }
}