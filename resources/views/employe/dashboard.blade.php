{{-- resources/views/employe/dashboard.blade.php --}}
@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <!-- En-tête de bienvenue -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-gradient-primary text-white p-4 rounded-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-1">Bonjour, {{ $nom }}! 👋</h2>
                            <p class="mb-0 opacity-75">{{ now()->translatedFormat('l d F Y') }}</p>
                        </div>
                        <div class="d-none d-md-block">
                            <i class="fas fa-chart-line fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Rapides -->
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-3"><i class="fas fa-bolt text-warning me-2"></i> Actions rapides</h4>
            </div>

            <div x-data class="col-md-3 col-6 mb-3">
                <div @click="window.location.href='{{ route('employe.conge.create') }}'"
                    class="card rounded-4 text-center shadow-sm stat-card" style="cursor: pointer;">
                    <div class="card-body py-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-block p-3 mb-2">
                            <i class="fas fa-calendar-plus fa-2x text-primary"></i>
                        </div>
                        <p class="mb-0 small fw-bold">Demander congé</p>
                    </div>
                </div>
            </div>

            <div x-data class="col-md-3 col-6 mb-3">
                <div @click="window.location.href='{{ route('employe.competences') }}'"
                    class="card rounded-4 text-center shadow-sm stat-card" style="cursor: pointer;">
                    <div class="card-body py-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 d-inline-block p-3 mb-2">
                            <i class="fas fa-star fa-2x text-warning"></i>
                        </div>
                        <p class="mb-0 small fw-bold">Mes compétences</p>
                    </div>
                </div>
            </div>

            <div x-data class="col-md-3 col-6 mb-3">
                <div @click="window.location.href='{{ route('employe.conge.index') }}'"
                    class="card rounded-4 text-center shadow-sm stat-card" style="cursor: pointer;">
                    <div class="card-body py-3">
                        <div class="rounded-circle bg-success bg-opacity-10 d-inline-block p-3 mb-2">
                            <i class="fas fa-list-alt fa-2x text-success"></i>
                        </div>
                        <p class="mb-0 small fw-bold">Mes congés</p>
                        <p class="mb-0 fw-bold text-primary">{{ $congesRestants }} restants</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card">
                    <div class="card-body py-3">
                        <div class="rounded-circle bg-info bg-opacity-10 d-inline-block p-3 mb-2">
                            <i class="fas fa-tasks fa-2x text-info"></i>
                        </div>
                        <p class="mb-0 small fw-bold">Tâches en cours</p>
                        <p class="mb-0 fw-bold text-info">{{ $tachesEnCours->count() }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <!-- Carte Profil -->
            <div class="col-md-4 mb-4">
                <div class="card rounded-4 shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-block p-3">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="text-center mb-1">{{ $nom }}</h5>
                        <p class="text-muted text-center small">{{ $poste ?? 'Poste non défini' }}</p>
                        <hr>
                        <p><i class="fas fa-envelope me-2 text-muted"></i> {{ $email }}</p>
                        <p><i class="fas fa-user-tag me-2 text-muted"></i> Rôle: <span
                                class="badge bg-primary">{{ ucfirst($employe->role) }}</span></p>
                        <p><i class="fas fa-user-tie me-2 text-muted"></i> Manager:
                            @if ($manager)
                                <strong>{{ $manager->name }}</strong>
                            @else
                                <span class="text-muted">Non assigné</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Carte Congés -->
            <div x-data class="col-md-4 mb-4" style="cursor: pointer"
                @click="window.location.href='{{ route('employe.conge.index') }}'">
                <div class="card rounded-4 shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5><i class="fas fa-calendar-alt me-2 text-success"></i> Mes congés</h5>
                        <hr>
                        <div class="progress mb-3" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar bg-success"
                                style="border-radius: 10px; width: {{ ($employe->conges_restants / $employe->conges_annules) * 100 }}%">
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="border-end">
                                    <small class="text-muted">Annuel</small>
                                    <p class="mb-0 fw-bold fs-4">{{ $employe->conges_annules }}</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-end">
                                    <small class="text-muted">Restant</small>
                                    <p class="mb-0 fw-bold text-primary fs-4">{{ $employe->conges_restants }}</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <small class="text-muted">Pris</small>
                                <p class="mb-0 fw-bold text-warning fs-4">
                                    {{ $employe->conges_annules - $employe->conges_restants }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte Charge -->
            <div class="col-md-4 mb-4">
                <div class="card rounded-4 shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5><i class="fas fa-chart-line me-2 text-info"></i> Charge de travail</h5>
                        <hr>
                        <div class="text-center mb-3">
                            <div class="position-relative d-inline-block">
                                <canvas id="chargeChart" width="150" height="150"></canvas>
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <span class="fw-bold fs-3">{{ $employe->charge_actuelle }}%</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted small text-center mb-0">Basé sur les tâches assignées</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tâches en cours -->
        <div class="card mt-4 mb-5 rounded-4 shadow-sm border-0">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4">
                <h5 class="mb-0 fw-bold"><i class="fas fa-tasks me-2 text-primary"></i> Mes tâches</h5>
            </div>
            <div class="card-body">
                @if ($taches->count() > 0)
                    @foreach ($taches as $maTache)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        @if ($maTache->statut == 'todo')
                                            <i class="fas fa-circle text-warning fa-xs"></i>
                                            <span class="badge bg-warning">À faire</span>
                                        @elseif($maTache->statut == 'doing')
                                            <i class="fas fa-circle text-primary fa-xs"></i>
                                            <span class="badge bg-primary">En cours</span>
                                        @else
                                            <i class="fas fa-circle text-success fa-xs"></i>
                                            <span class="badge bg-success">Terminé</span>
                                        @endif
                                        <h6 class="mb-0">{{ $maTache->titre }}</h6>
                                    </div>
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Deadline: {{ \Carbon\Carbon::parse($maTache->deadline)->format('d/m/Y') }}
                                    </p>
                                </div>
                                @if ($maTache->statut != 'done')
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary rounded-circle"
                                            data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-check me-2"></i>
                                                    Marquer terminée</a></li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle fa-4x text-muted opacity-25 mb-3"></i>
                        <p class="text-muted mb-0">Aucune tâche assignée</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Dernières demandes de congés -->
        <div class="card mt-4 mb-5 rounded-4 shadow-sm border-0">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4">
                <h5 class="mb-0 fw-bold"><i class="fas fa-clock me-2 text-warning"></i> Dernières demandes de congés</h5>
            </div>
            <div class="card-body">
                @if ($employe->conges->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Durée</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employe->conges->take(5) as $conge)
                                    <tr>
                                        <td>{{ $conge->date_debut->format('d/m/Y') }}</td>
                                        <td>{{ $conge->date_fin->format('d/m/Y') }}</td>
                                        <td>{{ $conge->date_debut->diffInDays($conge->date_fin) + 1 }} jours</td>
                                        <td>
                                            @if ($conge->statut == 'approved')
                                                <span class="badge bg-success"><i class="fas fa-check me-1"></i>
                                                    Validé</span>
                                            @elseif($conge->statut == 'refuse')
                                                <span class="badge bg-danger"><i class="fas fa-times me-1"></i>
                                                    Refusé</span>
                                            @else
                                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>
                                                    En attente</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-day fa-3x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucune demande de congé</p>
                        <a href="{{ route('employe.conge.create') }}" class="btn btn-sm btn-primary mt-2">
                            <i class="fas fa-plus me-1"></i> Faire une demande
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Graphique de charge
            const ctx = document.getElementById('chargeChart')?.getContext('2d');
            if (ctx) {
                const charge = {{ $employe->charge_actuelle }};
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [charge, 100 - charge],
                            backgroundColor: ['#0d6efd', '#e9ecef'],
                            borderWidth: 0,
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        }
                    }
                });
            }
        </script>

        <style>
            .stat-card {
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            }

            .bg-gradient-primary {
                background: linear-gradient(135deg, #1e3a5f 0%, #2c5a8c 100%);
            }
        </style>
    @endpush
@endsection
