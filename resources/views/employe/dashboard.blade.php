{{-- resources/views/employe/dashboard.blade.php --}}
<x-app-layout>
    {{-- Dashobard  --}}
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-gradient-primary text-white p-4 rounded-4 shadow-sm" style="background: #1e3a5f">
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
                <h4 class="mb-3 text-dark">Actions rapides</h4>
            </div>

            {{-- Taches en cours --}}
            <div class="col-md-3 col-6 mb-3">
                <a href="#tachesEnCours" class="text-decoration-none">
                    <div class="card rounded-4 text-center shadow-sm stat-card border-0"
                        style="cursor: pointer; background: white;">
                        <div class="card-body py-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-block p-3 mb-2">
                                <i class="fas fa-tasks fs-4 text-primary"></i>
                            </div>
                            <p class="mb-0 small fw-bold text-dark">Mes Tâches</p>
                            <p class="mb-0 fw-bold text-primary">{{ $tachesEnCours->count() ?? 0 }}</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Déplacements --}}
            <div class="col-md-3 col-6">
                <a href="mesDeplacements" class="text-decoration-none">
                    <div class="card rounded-4 text-center shadow-sm stat-card border-0"
                        style="cursor: pointer; background:white">
                        <div class="card-body py-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-block p-3 mb-2">
                                <i class="fas fa-car fs-4 text-primary"></i>
                            </div>
                            <p class="mb-0 small fw-bold text-dark">Mes Déplacements</p>
                            <p class="mb-0 fw-bold text-primary">{{ $mesDeplacements->count() ?? 0 }}</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Conges restats --}}
            <div class="col-md-3 col-6 mb-3">
                <a href="#congesRestants" class="text-decoration-none">
                    <div class="card rounded-4 text-center shadow-sm stat-card border-0"
                        style="cursor: pointer; background: white">
                        <div class="card-body py-3">
                            <div class="rounded-circle bg-success bg-opacity-10 d-inline-block p-3 mb-2">
                                <i class="fas fa-calendar-alt fs-4 text-success"></i>
                            </div>
                            <p class="mb-0 small fw-bold text-dark">Congés restants</p>
                            <p class="mb-0 fw-bold text-success">{{ $congesRestants }}</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- performances --}}
            <div class="col-md-3 col-6 mb-3">
                <a href="#performance" class="text-decoration-none">
                    <div class="card rounded-4 text-center shadow-sm stat-card border-0"
                        style="cursor: pointer;background: white">
                        <div class="card-body py-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-block p-3 mb-2">
                                <i class="fas fa-chart-line fs-4 text-danger"></i>
                            </div>
                            <p class="mb-0 small fw-bold text-dark">Performance</p>
                            <p class="mb-0 fw-bold text-danger">--%</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- competences --}}
            <div class="col-md-3 col-6 mb-3">
                <a href="#competences" class="text-decoration-none">
                    <div class="card rounded-4 text-center shadow-sm stat-card border-0" style="background: white;">
                        <div class="card-body py-3">
                            <div class="rounded-circle bg-warning bg-opacity-10 d-inline-block p-3 mb-2">
                                <i class="fas fa-star fs-4 text-warning"></i>
                            </div>
                            <p class="mb-0 small fw-bold text-dark">Compétences</p>
                            <p class="mb-0 fw-bold text-warning">{{ $mesCompetences->count() }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Tâches -->
        <div id="tachesEnCours" class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background: white">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4">
                <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-tasks me-2 text-primary"></i> Mes tâches</h5>
                <span class = "bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                    {{ $tachesEnCours->count() }} tâches en cours
                </span>
                <span class="text-decoration-underline text-primary"><a href="{{ route('employe.tache.index') }}">Voir
                        toutes les tâc hes</a></span>
            </div>
            <div class="card-body">
                @if (isset($taches) && $taches->count() > 0)
                    @foreach ($taches as $tache)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        @if ($tache->statut === 'todo')
                                            <span class="badge bg-warning text-dark">A faire</span>
                                        @elseif($tache->statut === 'doing')
                                            <span class="badge bg-primary">En Cours</span>
                                        @else
                                            <span class="badge bg-success">Terminé</span>
                                        @endif
                                        <h6 class="mb-0 text-dark">{{ $tache->titre }}</h6>
                                    </div>
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Deadline: {{ \Carbon\Carbon::parse($tache->deadline)->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Aucune tâche trouvée</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Congés -->
        <div id="congesRestants" class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background:white">
            <div
                class="card-header bg-white rounded-top-4 border-0 pt-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-calendar-alt me-2 text-success"></i> Mes dernières
                    demandes</h5>
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                    {{ $employe->conges->count() }} demandes
                </span>
                <span class="text-decoration-underline text-primary"><a href="{{ route('employe.conge.index') }}">Voir
                        tous les demandes</a></span>
            </div>
            <div class="card-body">
                @if ($employe->conges->count() > 0)
                    @foreach ($cinqDerniersConges as $conge)
                        <div class="border-bottom pb-3 mb-3" style="cursor:pointer; transition:0.3s;"
                            onclick="window.location.href='{{ route('employe.conge.show', $conge->id) }}'">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        @if ($conge->statut === 'pending')
                                            <span class="badge bg-warning text-dark rounded-pill px-3">Enattente</span>
                                        @elseif($conge->statut === 'approved')
                                            <span class="badge bg-success rounded-pill px-3">Acceptéé</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-3">Reeffusé</span>
                                        @endif
                                        <h6 class="mb-0 fw-bold text-dark">{{ $conge->motif ?: 'Sans motif' }}</h6>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-primary small fw-semibold">
                                            Type :
                                            @if ($conge->type == 'paye')
                                                Congé payé
                                            @elseif($conge->type == 'rtt')
                                                RTT
                                            @elseif($conge->type == 'sans_solde')
                                                Sans solde
                                            @else
                                                Formation
                                            @endif
                                        </span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-calendar-day me-1"></i>
                                            Début : {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}
                                        </p>
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-calendar-check me-1"></i>
                                            Fin : {{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-week fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Aucune demande de congé</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Déplacements --}}
        <div id="mesDeplacements" class = "card mb-4 rounded-4 shadow-sm border-0">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-car m2"></i>Mes Déplacements
                </h5>
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                    {{ $mesDeplacements->count() ?? 0 }}
                </span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @if ($mesDeplacements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead style="background-color: #e8f0fe; color: #1e3a5f;">
                                    <tr>
                                        <th class="py-3">Dates</th>
                                        <th class="py-3">Lieu</th>
                                        <th class="py-3">Client</th>
                                        <th class="py-3">Frais</th>
                                        <th class="py-3">Statut</th>
                                        <th class="py-3 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mesDeplacements as $deplacement)
                                        <tr
                                            style="border-left: 4px solid
                                        @if ($deplacement->statut == 'pending') #ffc107
                                        @elseif($deplacement->statut == 'approved') #198754
                                        @else #dc3545 @endif">
                                            <td>
                                                <span
                                                    class="fw-semibold">{{ \Carbon\Carbon::parse($deplacement->date_debut)->format('d/m/Y') }}</span>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-arrow-right me-1"></i>
                                                    {{ \Carbon\Carbon::parse($deplacement->date_fin)->format('d/m/Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <i class="fas fa-map-marker-alt me-1" style="color: #1e3a5f;"></i>
                                                {{ $deplacement->lieu }}
                                            </td>
                                            <td>
                                                @if ($deplacement->client)
                                                    <i class="fas fa-building me-1 text-muted"></i>
                                                    {{ $deplacement->client }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fw-semibold" style="color: #198754;">
                                                    {{ number_format($deplacement->frais_total, 2) }} DH
                                                </span>
                                            </td>
                                            <td>
                                                @if ($deplacement->statut == 'pending')
                                                    <span class="badge rounded-pill px-3 py-2"
                                                        style="background: #ffc107; color: #000;">
                                                        <i class="fas fa-clock me-1"></i> En attente
                                                    </span>
                                                @elseif($deplacement->statut == 'approved')
                                                    <span class="badge rounded-pill px-3 py-2"
                                                        style="background: #198754;">
                                                        <i class="fas fa-check-circle me-1"></i> Accepté
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill px-3 py-2"
                                                        style="background: #dc3545;">
                                                        <i class="fas fa-times-circle me-1"></i> Refusé
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('employe.deplacement.show', $deplacement->id) }}"
                                                    class="btn btn-sm rounded-pill px-3"
                                                    style="background: #1e3a5f; color: white; border: none;">
                                                    <i class="fas fa-eye me-1"></i> Voir
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-4"
                                    style="width: 100px; height: 100px;">
                                    <i class="fas fa-plane fa-3x" style="color: #1e3a5f;"></i>
                                </div>
                            </div>
                            <h5 class="text-muted">Aucun déplacement demandé</h5>
                            <p class="text-muted">Vous n'avez pas encore fait de demande de déplacement.</p>
                            <a href="{{ route('employe.deplacement.create') }}" class="btn rounded-pill px-4 mt-2"
                                style="background: #1e3a5f; color: white; border: none;">
                                <i class="fas fa-plus me-2"></i> Demander un déplacement
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Compétences -->
        <div id="competences" class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background: white">
            <div
                class="card-header bg-white rounded-top-4 border-0 pt-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-star me-2 text-warning"></i> Mes compétences</h5>
                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                    {{ $mesCompetences->count() }} compétences
                </span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @if (isset($mesCompetences) && $mesCompetences->count() > 0)
                        @foreach ($mesCompetences as $competence)
                            <div class="col-md-3">
                                <div class="border rounded-3 p-2 text-center bg-light">
                                    <i class="fas fa-code text-primary"></i>
                                    <span class="ms-1">{{ $competence->nom }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Aucune compétence enregistrée</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Performances --}}
        <div id="performance" class="card mb-4 mt-4 rounded-4 shadow-sm border-0" style="background: white">
            <div class="card-header bg-white rounded-top-4 border-0 pt-4">
                <h5 class="mb-0 fw-bold" style="color: #1e3a5f;">
                    <i class="fas fa-chart-line me-2"></i> Évolution de ma performance
                </h5>
            </div>
            <div class="card-body">
                <canvas id="performanceChart" width="400" height="200"></canvas>
            </div>
        </div>
        
</x-app-layout>
