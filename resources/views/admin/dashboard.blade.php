<x-app-layout>
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="text-white p-4 rounded-4 shadow-sm" style="background: #1e3a5f">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-1">Bonjour, {{ Auth::user()->name }}</h2>
                            <p class="mb-0 opacity-75">{{ now()->translatedFormat('l d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-3 text-dark">Statistiques globales</h4>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white;">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(30, 58, 95, 0.1);">
                            <i class="fas fa-users fs-4" style="color: #1e3a5f;"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Employés</p>
                        <p class="mb-0 fw-bold" style="color: #1e3a5f;">{{ $totalEmployes ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(25, 135, 84, 0.1);">
                            <i class="fas fa-user-tie fs-4" style="color: #198754;"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Managers</p>
                        <p class="mb-0 fw-bold text-success">{{ $totalManagers ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(13, 202, 240, 0.1);">
                            <i class="fas fa-star fs-4" style="color: #0dcaf0;"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Compétences</p>
                        <p class="mb-0 fw-bold text-info">{{ $totalCompetences ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(255, 193, 7, 0.1);">
                            <i class="fas fa-chart-line fs-4" style="color: #ffc107;"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Charge moyenne</p>
                        <p class="mb-0 fw-bold text-warning">{{ round($chargeMoyenne ?? 0) }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card rounded-4 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="text-muted">En attente</h5>
                        <h3 class="text-warning">{{ $congesEnAttente ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card rounded-4 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Approuvés</h5>
                        <h3 class="text-success">{{ $congesApprouves ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card rounded-4 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="text-muted">Refusés</h5>
                        <h3 class="text-danger">{{ $congesRefuses ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Derniers employés -->
        <div class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background: white">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4">
                <h5 class="mb-0 fw-bold" style="color: #1e3a5f;"><i class="fas fa-user-plus me-2"></i> Derniers employés</h5>
            </div>
            <div class="card-body">
                @if(isset($derniersEmployes) && $derniersEmployes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Poste</th>
                                    <th>Date d'ajout</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($derniersEmployes as $employe)
                                <tr>
                                    <td><strong>{{ $employe->name }}</strong></td>
                                    <td>{{ $employe->email }}</td>
                                    <td>{{ $employe->poste ?? 'Non défini' }}</td>
                                    <td>{{ $employe->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Aucun employé</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Dernières demandes -->
        <div class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background:white">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold" style="color: #1e3a5f;"><i class="fas fa-calendar-alt me-2"></i> Dernières demandes</h5>
            </div>
            <div class="card-body">
                @if(isset($dernieresDemandes) && $dernieresDemandes->count() > 0)
                    @foreach($dernieresDemandes as $demande)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <strong>{{ $demande->user->name ?? 'N/A' }}</strong>
                                        <span class="badge" style="background: #0dcaf0;">{{ $demande->type }}</span>
                                        <span class="badge
                                            @if($demande->statut == 'pending') bg-warning text-dark
                                            @elseif($demande->statut == 'approved') bg-success
                                            @else bg-danger @endif">
                                            {{ $demande->statut }}
                                        </span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-calendar-day me-1"></i>
                                            {{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }} →
                                            {{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-week fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Aucune demande</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>