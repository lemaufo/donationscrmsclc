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
        $donations = Donation::where('collaborator_id', $this->collaborator->id)
            ->where('status', 'paid')
            ->latest('paid_at')
            ->take(10)
            ->get();

        $this->totalRaised    = (float) $donations->sum('amount');
        $this->donationCount  = $donations->count();
        $this->recentDonations = $donations->map(fn($d) => [
            'amount'     => $d->amount,
            'donor_name' => $d->donor_name ?? 'Anónimo',
            'paid_at'    => $d->paid_at?->diffForHumans(),
        ])->toArray();

        // Calcular posición en el ranking
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