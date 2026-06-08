{{-- resources/views/manager/dashboard.blade.php --}}
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
                <h4 class="mb-3 text-dark">Vue d'ensemble</h4>
            </div>

            <div class="col-md-4 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white;">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(30, 58, 95, 0.1);">
                            <i class="fas fa-users fs-4" style="color: #1e3a5f;"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Mon équipe</p>
                        <p class="mb-0 fw-bold" style="color: #1e3a5f;">{{ $employes->count() ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(255, 193, 7, 0.1);">
                            <i class="fas fa-clock fs-4 text-warning"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Demandes en attente</p>
                        <p class="mb-0 fw-bold text-warning">{{ $demandesEnAttente ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-6 mb-3">
                <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white">
                    <div class="card-body py-3">
                        <div class="rounded-circle d-inline-block p-3 mb-2" style="background: rgba(25, 135, 84, 0.1);">
                            <i class="fas fa-chart-line fs-4 text-success"></i>
                        </div>
                        <p class="mb-0 small fw-bold text-dark">Charge moyenne</p>
                        <p class="mb-0 fw-bold text-success">{{ round($chargeMoyenne ?? 0) }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mon équipe -->
        <div class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background: white">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4">
                <h5 class="mb-0 fw-bold" style="color: #1e3a5f;"><i class="fas fa-users me-2"></i> Mon équipe</h5>
            </div>
            <div class="card-body">
                @if (isset($employes) && $employes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Employé</th>
                                    <th>Poste</th>
                                    <th>Charge</th>
                                    <th>Congés restants</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employes as $employe)
                                    <tr>
                                        <td><strong>{{ $employe->name }}</strong></td>
                                        <td>{{ $employe->poste ?? 'Employé' }}</td>
                                        <td style="width: 150px;">
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1" style="height: 8px;">
                                                    @php
                                                        $chargeClass = 'bg-success';
                                                        if ($employe->charge_actuelle > 120) {
                                                            $chargeClass = 'bg-danger';
                                                        } elseif ($employe->charge_actuelle > 90) {
                                                            $chargeClass = 'bg-warning';
                                                        }
                                                    @endphp
                                                    <div class="progress-bar {{ $chargeClass }}"
                                                        style="width: {{ min($employe->charge_actuelle, 100) }}%">
                                                    </div>
                                                </div>
                                                <span class="ms-2 small">{{ round($employe->charge_actuelle) }}%</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge" style="background: #1e3a5f;">{{ $employe->conges_restants }} jours</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('manager.conges.index') }}" class="btn btn-sm btn-outline-primary" style="border-color: #1e3a5f; color: #1e3a5f;">
                                                <i class="fas fa-eye"></i> Voir demandes
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Aucun employé dans votre équipe</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Demandes en attente -->
        <div id="demandes" class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background:white">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold" style="color: #1e3a5f;"><i class="fas fa-clock me-2 text-warning"></i> Demandes en attente</h5>
            </div>
            <div class="card-body">
                @if (isset($demandes) && $demandes->count() > 0)
                    @foreach ($demandes as $demande)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge bg-warning text-dark">⏳ En attente</span>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $demande->user->name }}</h6>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge" style="background: #e8f0fe; color: #1e3a5f;">
                                            <i class="fas fa-tag me-1"></i>
                                            @if ($demande->type == 'paye')
                                                Congé payé
                                            @elseif($demande->type == 'rtt')
                                                RTT
                                            @elseif($demande->type == 'sans_solde')
                                                Sans solde
                                            @else
                                                Formation
                                            @endif
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
                                <div>
                                    <a href="{{ route('manager.conges.show', $demande->id) }}"
                                        class="btn btn-sm" style="background: #1e3a5f; color: white;">
                                        <i class="fas fa-eye"></i> Traiter
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <p class="text-muted mb-0">Aucune demande en attente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>