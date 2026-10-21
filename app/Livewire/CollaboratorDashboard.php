<?php

namespace App\Livewire;

use App\Models\Collaborator;
use App\Models\Donation;
use Livewire\Component;

class CollaboratorDashboard extends Component
{
    public Collaborator $collaborator;
    public float $totalRaised = 0;
    public int $donationCount = 0;
    public array $recentDonations = [];
    public int $ranking = 0;

    public function mount(Collaborator $collaborator): void
    {
        $this->collaborator = $collaborator;
        $this->loadData();
    }

    public function loadData(): void
    {
        // Query completo para totales (sin take)
        $allDonations = Donation::where('collaborator_id', $this->collaborator->id)
            ->where('status', 'paid')
            ->get();

        $this->totalRaised   = (float) $allDonations->sum('amount');
        $this->donationCount = $allDonations->count();

        // Solo las últimas 10 para mostrar en la lista
        $this->recentDonations = Donation::where('collaborator_id', $this->collaborator->id)
            ->where('status', 'paid')
            ->latest('paid_at')
            ->take(10)
            ->get()
            ->map(fn($d) => [
                'amount'     => $d->amount,
                'donor_name' => $d->donor_name ?? 'Anónimo',
                'paid_at'    => $d->paid_at?->diffForHumans(),
            ])->toArray();

        // Ranking (sin cambios)
        $this->ranking = \App\Models\Collaborator::where('campaign_id', $this->collaborator->campaign_id)
            ->where('is_active', true)
            ->withSum(['donations as total_raised' => fn($q) => $q->where('status', 'paid')], 'amount')
            ->orderByDesc('total_raised')
            ->get()
            ->search(fn($c) => $c->id === $this->collaborator->id) + 1;
    }

    public function render()
    {
        return view('livewire.collaborator-dashboard');
    }
}