<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Collaborator;
use Illuminate\View\View;

class CollaboratorController extends Controller
{
    public function show(string $ref_code): View
    {
        $collaborator = Collaborator::where('ref_code', $ref_code)
            ->where('is_active', true)
            ->firstOrFail();

        $campaign = Campaign::where('is_active', true)->first();

        return view('collaborator.show', compact('collaborator', 'campaign'));
    }
}