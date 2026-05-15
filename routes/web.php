<?php

use App\Http\Controllers\Employe\CompetenceController;
use App\Http\Controllers\Employe\CongeController;
use App\Http\Controllers\Employe\EmployeDashboardController;
use App\Http\Controllers\Employe\ProfileController;
use App\Http\Controllers\Manager\ManagerDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isManager()) {
            return redirect()->route('manager.dashboard');
        }

        return redirect()->route('employe.dashboard');
    })->name('dashboard');

    Route::middleware(['employe'])->prefix('employe')->name('employe.')->group(function () {
        Route::get('/dashboard', [EmployeDashboardController::class, 'index'])->name('dashboard');
        Route::get('/competences', [CompetenceController::class, 'index'])->name('competences');
        Route::put('/competences', [CompetenceController::class, 'update'])->name('competences.update');

        Route::get('/conges', [CongeController::class, 'index'])->name('conge.index');
        Route::get('/conges/create', [CongeController::class, 'create'])->name('conge.create');
        Route::post('/conges', [CongeController::class, 'store'])->name('conge.store');
        Route::post('/conge/store', [CongeController::class, 'store'])->name('conge.store');
        Route::get('/conges/{id}', [CongeController::class, 'show'])->name('conge.show');
        Route::delete('/conges/{id}', [CongeController::class, 'annuler'])->name('conge.annuler');

        Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    });

});

Route::middleware(['manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
    Route::get('/conges/{id}', [CongeController::class, 'show'])->name('conges.show');
    Route::post('/conges/{id}/accepter', [CongeController::class, 'accepter'])->name('conges.accepter');
    Route::post('/conges/{id}/refuser', [CongeController::class, 'refuser'])->name('conges.refuser');
});

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::get('/test-mail', function () {
    try {
        Mail::raw('Test Mail OK', function ($message) {
            $message->to('aoudanesoukaina@gmail.com')
                ->subject('Test HR-Smart');
        });

        return 'MAIL EXECUTE ✔';
    } catch (\Exception $e) {
        return 'ERREUR SMTP: ' . $e->getMessage();
    }
});
