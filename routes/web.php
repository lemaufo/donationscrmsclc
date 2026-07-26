<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\CollaboratorRegistrationController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\AdminController;

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('home');

// Laravel auth routes
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Stripe webhook — sin middleware de campaña
Route::post('/stripe/webhook', [App\Http\Controllers\StripeWebhookController::class, 'handle'])
    ->name('stripe.webhook');

// Admin — sin middleware de campaña
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/export', [AdminController::class, 'exportCsv'])->name('admin.export');
Route::get('/admin/campanas', [App\Http\Controllers\Admin\CampaignController::class, 'index'])->name('admin.campaigns.index');
Route::get('/admin/campanas/nueva', [App\Http\Controllers\Admin\CampaignController::class, 'create'])->name('admin.campaigns.create');
Route::post('/admin/campanas', [App\Http\Controllers\Admin\CampaignController::class, 'store'])->name('admin.campaigns.store');
Route::get('/admin/campanas/{campaign}/editar', [App\Http\Controllers\Admin\CampaignController::class, 'edit'])->name('admin.campaigns.edit');
Route::put('/admin/campanas/{campaign}', [App\Http\Controllers\Admin\CampaignController::class, 'update'])->name('admin.campaigns.update');
Route::patch('/admin/campanas/{campaign}/toggle', [App\Http\Controllers\Admin\CampaignController::class, 'toggle'])->name('admin.campaigns.toggle');

// Rutas públicas — requieren campaña activa
Route::middleware([App\Http\Middleware\RequireActiveCampaign::class])->group(function () {
    Route::get('/donar', [DonationController::class, 'show'])->name('donation.show');
    Route::post('/donar', [DonationController::class, 'store'])->name('donation.store');
    Route::get('/donar/gracias/{donation}', [DonationController::class, 'success'])->name('donation.success');
    Route::get('/colaborador/{ref_code}', [CollaboratorController::class, 'show'])->name('collaborator.show');
    Route::get('/unirse/{token}', [CollaboratorRegistrationController::class, 'show'])->name('collaborator.register.show');
    Route::post('/unirse/{token}', [CollaboratorRegistrationController::class, 'store'])->name('collaborator.register.store');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
});

require __DIR__.'/auth.php';