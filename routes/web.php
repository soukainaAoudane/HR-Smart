<?php

use App\Http\Controllers\AdminRH\DashboardController as AdminDashboardController;
use App\Http\Controllers\AdminRH\EmployeController;
use App\Http\Controllers\Employe\CompetenceController;
use App\Http\Controllers\Employe\CongeController;
use App\Http\Controllers\Employe\DeplacementController as EmployeDeplacementController;
use App\Http\Controllers\Employe\EmployeDashboardController;
use App\Http\Controllers\Employe\ProfileController;
use App\Http\Controllers\Employe\TacheController;
use App\Http\Controllers\Manager\CompetenceController as ManagerCompetenceController;
use App\Http\Controllers\Manager\CongeController as ManagerCongeController;
use App\Http\Controllers\Manager\DeplacementController as ManagerDeplacementController;
use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Manager\TacheController as ManagerTacheController;
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
        Route::get('/conges/{id}', [CongeController::class, 'show'])->name('conge.show');
        Route::delete('/conges/{id}', [CongeController::class, 'annuler'])->name('conge.annuler');

        Route::get('/taches', [TacheController::class, 'index'])->name('tache.index');
        Route::put('/tache/{id}', [TacheController::class, 'update'])->name('tache.update');

        Route::get('/deplacements', [EmployeDeplacementController::class, 'index'])->name('deplacement.index');
        Route::get('/deplacement/create', [EmployeDeplacementController::class, 'create'])->name('deplacement.create');
        Route::post('/deplacement/store', [EmployeDeplacementController::class, 'store'])->name('deplacement.store');
        Route::get('/deplacement/{id}', [EmployeDeplacementController::class, 'show'])->name('deplacement.show');
        Route::delete('/deplacement/{id}', [EmployeDeplacementController::class, 'destroy'])->name('deplacement.destroy');

        Route::post('/remplacement/{id}/accepter', [CongeController::class, 'accepterRemplacement'])->name('remplacement.accepter');
        Route::post('/remplacement/{id}/refuser', [CongeController::class, 'refuserRemplacement'])->name('remplacement.refuser');

        Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    });

    Route::middleware(['manager'])->prefix('manager')->name('manager.')->group(function () {

        Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

        Route::get('/conges', [ManagerCongeController::class, 'index'])->name('conges.index');
        Route::get('/conges/{id}', [ManagerCongeController::class, 'show'])->name('conges.show');
        Route::post('/conges/{id}/accepter', [ManagerCongeController::class, 'accepter'])->name('conges.accepter');
        Route::post('/conges/{id}/refuser', [ManagerCongeController::class, 'refuser'])->name('conges.refuser');
        Route::get('/conges/{id}/propositions', [ManagerCongeController::class, 'propositions'])->name('conges.propositions');
        Route::post('/conges/{id}/proposer', [ManagerCongeController::class, 'proposer'])->name('conge.proposer');

        Route::get('/taches', [ManagerTacheController::class, 'index'])->name('tache.index');
        Route::get('/tache/create', [ManagerTacheController::class, 'create'])->name('tache.create');
        Route::post('/tache/store', [ManagerTacheController::class, 'store'])->name('tache.store');
        Route::get('/tache/{id}', [ManagerTacheController::class, 'show'])->name('tache.show');
        Route::get('/tache/{id}/edit', [ManagerTacheController::class, 'edit'])->name('tache.edit');
        Route::put('/tache/{id}', [ManagerTacheController::class, 'update'])->name('tache.update');
        Route::delete('/tache/{id}', [ManagerTacheController::class, 'destroy'])->name('tache.destroy');

        Route::get('/deplacements', [ManagerDeplacementController::class, 'index'])->name('deplacement.index');
        Route::get('/deplacement/{id}', [ManagerDeplacementController::class, 'show'])->name('deplacement.show');
        Route::post('/deplacement/{id}/accepter', [ManagerDeplacementController::class, 'accepter'])->name('deplacement.accepter');
        Route::post('/deplacement/{id}/refuser', [ManagerDeplacementController::class, 'refuser'])->name('deplacement.refuser');

        Route::get('/competences', [ManagerCompetenceController::class, 'index'])->name('competences.index');
        Route::get('/competences/{id}', [ManagerCompetenceController::class, 'show'])->name('competences.show');
        Route::post('/competences/{employeId}/{competenceId}/valider', [ManagerCompetenceController::class, 'valider'])->name('competences.valider');
        Route::post('/competences/{employeId}/{competenceId}/refuser', [ManagerCompetenceController::class, 'refuser'])->name('competences.refuser');
    });

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');
        Route::post('/employes/{id}/manager', [EmployeController::class, 'updateManager'])->name('employes.updateManager');

        Route::get('/competences', [CompetenceController::class, 'index'])->name('competences.index');
        Route::get('/competences/create', [CompetenceController::class, 'create'])->name('competences.create');
        Route::post('/competences', [CompetenceController::class, 'store'])->name('competences.store');
        Route::get('/competences/{id}/edit', [CompetenceController::class, 'edit'])->name('competences.edit');
        Route::put('/competences/{id}', [CompetenceController::class, 'update'])->name('competences.update');
        Route::delete('/competences/{id}', [CompetenceController::class, 'destroy'])->name('competences.destroy');
    });
});

// Routes de test
Route::get('/test', function () {
    return view('test');
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
