<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::withCount('collaborators')
            ->withSum('donations as total_raised', 'amount')
            ->latest()
            ->get();

        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'slug'            => 'required|string|unique:campaigns,slug|max:100',
            'starts_at' => 'required|date',
            'ends_at'   => 'required|date|after:starts_at',
            'goal_amount'     => 'nullable|numeric|min:0',
            'theme_color'     => 'nullable|string|max:7',
            'logo'            => 'nullable|image|max:2048',
            'banner'          => 'nullable|image|max:2048',
            'welcome_message' => 'nullable|string|max:500'
        ]);

        $data = [
            'name'               => $validated['name'],
            'slug'               => $validated['slug'],
            'starts_at'          => $validated['starts_at'],
            'event_date' => $validated['starts_at'], // usa starts_at como event_date
            'ends_at'            => $validated['ends_at'],
            'goal_amount'        => $validated['goal_amount'] ?? null,
            'theme_color'        => $validated['theme_color'] ?? '#dc2626',
            'welcome_message'    => $validated['welcome_message'] ?? null,
            'registration_token' => \Illuminate\Support\Str::random(32),
            'is_active'          => false,
        ];

        if ($request->hasFile('logo')) {
            $data['logo_url'] = $request->file('logo')->store('campaigns/logos', 'public');
        }

        if ($request->hasFile('banner')) {
            $data['banner_url'] = $request->file('banner')->store('campaigns/banners', 'public');
        }

        Campaign::create($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaña creada correctamente.');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'starts_at' => 'required|date',
            'ends_at'   => 'required|date|after:starts_at',
            'goal_amount'     => 'nullable|numeric|min:0',
            'theme_color'     => 'nullable|string|max:7',
            'logo'            => 'nullable|image|max:2048',
            'banner'          => 'nullable|image|max:2048',
            'event_date' => 'nullable|date',
            'welcome_message' => 'nullable|string|max:500',
        ]);

        $data = [
            'name'            => $validated['name'],
            'event_date'      => $validated['starts_at'],
            'starts_at'       => $validated['starts_at'],
            'ends_at'         => $validated['ends_at'],
            'goal_amount'     => $validated['goal_amount'] ?? null,
            'theme_color'     => $validated['theme_color'] ?? '#dc2626',
            'welcome_message' => $validated['welcome_message'] ?? null,
        ];

        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe
            if ($campaign->logo_url) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($campaign->logo_url);
            }
            $data['logo_url'] = $request->file('logo')->store('campaigns/logos', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($campaign->banner_url) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($campaign->banner_url);
            }
            $data['banner_url'] = $request->file('banner')->store('campaigns/banners', 'public');
        }

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaña actualizada.');
    }

    public function toggle(Campaign $campaign)
    {
        // Solo una campaña activa a la vez
        if (!$campaign->is_active) {
            Campaign::where('is_active', true)->update(['is_active' => false]);
        }

        $campaign->update(['is_active' => !$campaign->is_active]);

        return back()->with('success', $campaign->is_active ? 'Campaña activada.' : 'Campaña desactivada.');
    }
}