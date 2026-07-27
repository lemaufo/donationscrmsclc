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

// Stripe webhook — sin middleware
Route::post('/stripe/webhook', [App\Http\Controllers\StripeWebhookController::class, 'handle'])
    ->name('stripe.webhook');

Route::get('/dashboard', function () {
    return redirect()->route('admin.index');
})->middleware(['auth'])->name('dashboard');

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

// Bloquear registro público
Route::get('/register', function () { abort(403); });
Route::post('/register', function () { abort(403); });

// Admin — requiere auth + rol
Route::middleware(['auth', App\Http\Middleware\RequireAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/export', [AdminController::class, 'exportCsv'])->name('admin.export');
    Route::get('/admin/campanas', [App\Http\Controllers\Admin\CampaignController::class, 'index'])->name('admin.campaigns.index');
    Route::get('/admin/campanas/nueva', [App\Http\Controllers\Admin\CampaignController::class, 'create'])->name('admin.campaigns.create');
    Route::post('/admin/campanas', [App\Http\Controllers\Admin\CampaignController::class, 'store'])->name('admin.campaigns.store');
    Route::get('/admin/campanas/{campaign}/editar', [App\Http\Controllers\Admin\CampaignController::class, 'edit'])->name('admin.campaigns.edit');
    Route::put('/admin/campanas/{campaign}', [App\Http\Controllers\Admin\CampaignController::class, 'update'])->name('admin.campaigns.update');
    Route::patch('/admin/campanas/{campaign}/toggle', [App\Http\Controllers\Admin\CampaignController::class, 'toggle'])->name('admin.campaigns.toggle');

    // Gestión de usuarios — solo superadmin
    Route::get('/admin/usuarios', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/usuarios/nuevo', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/usuarios', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/usuarios/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Laravel settings (auth)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';