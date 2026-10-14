<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collaborator;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function index(Request $request)
    {

        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isViewer()) {
            abort(403);
        }

        $campaign = Campaign::where('is_active', true)->first();
        $search   = $request->query('search');

        $collaborators = Collaborator::where('campaign_id', $campaign->id)
            ->when($search, fn($q) => $q->where('email', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('ref_code', 'LIKE', "%{$search}%"))
            ->orderBy('name')
            ->paginate(50);

        return view('admin.collaborators.index', compact('collaborators', 'search', 'campaign'));
    }

    public function export(Request $request)
    {

        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isViewer()) {
            abort(403);
        }

        $campaign = Campaign::where('is_active', true)->first();

        $collaborators = Collaborator::where('campaign_id', $campaign->id)
            ->withCount(['donations as paid_donations_count' => fn($q) => $q->where('status', 'paid')])
            ->withSum(['donations as total_raised' => fn($q) => $q->where('status', 'paid')], 'amount')
            ->orderBy('name')
            ->get();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="colaboradores-' . now()->format('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () use ($collaborators) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, [
                'ID Colaborador',
                'Nombre',
                'Correo',
                'Usuario',
                'Área',
                'Ref. Code',
                'Iniciales',
                'Donaciones',
                'Total recaudado (MXN)',
                'Fecha registro',
            ]);

            foreach ($collaborators as $c) {
                fputcsv($handle, [
                    $c->id,
                    $c->name,
                    $c->email,
                    explode('@', $c->email)[0],
                    $c->department ?? '',
                    $c->ref_code,
                    $c->initials ?? '',
                    $c->paid_donations_count ?? 0,
                    number_format($c->total_raised ?? 0, 2),
                    $c->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}