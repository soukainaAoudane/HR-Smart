<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4 d-flex justify-content-between align-items-center" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">Mes projets</h4>
                <a href="{{ route('manager.projet.create') }}" class="btn btn-light btn-sm rounded-pill">
                    <i class="fas fa-plus me-1"></i> Nouveau projet
                </a>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($projets->count() > 0)
                    <div class="row">
                        @foreach($projets as $projet)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="fw-bold mb-0" style="color: #1e3a5f;">{{ $projet->nom }}</h5>
                                            <span class="badge rounded-pill px-3 py-2" style="background:
                                                @if($projet->statut == 'en_attente') #ffc107; color:#000
                                                @elseif($projet->statut == 'en_cours') #0dcaf0
                                                @elseif($projet->statut == 'termine') #198754
                                                @else #dc3545 @endif">
                                                @if($projet->statut == 'en_attente') En attente
                                                @elseif($projet->statut == 'en_cours')En cours
                                                @elseif($projet->statut == 'termine')Terminé
                                                @else Annulé @endif
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-3">{{ Str::limit($projet->description, 100) }}</p>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Avancement</span>
                                                <span>{{ $projet->avancement }}%</span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: {{ $projet->avancement }}%"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between small text-muted mb-3">
                                            <span><i class="fas fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($projet->date_debut)->format('d/m/Y') }}</span>
                                            <span><i class="fas fa-users me-1"></i> {{ $projet->employes->count() }} membres</span>
                                            <span><i class="fas fa-coins me-1"></i> {{ number_format($projet->budget_previsionnel, 0) }} DH</span>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('manager.projet.show', $projet->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                            <a href="{{ route('manager.projet.edit', $projet->id) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun projet</p>
                        <a href="{{ route('manager.projet.create') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-plus me-2"></i> Créer un projet
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
