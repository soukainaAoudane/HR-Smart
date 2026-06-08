<x-app-layout>
    {{-- Affichages des taches --}}
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4 d-flex justify-content-between align-items-center" style="background: #1e3a5f; border-bottom: none;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-tasks fs-4 me-3"></i>
                    <h4 class="mb-0 fw-bold">Gestion des tâcches</h4>
                </div>
                <a href="{{ route('manager.tache.create') }}" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Nouvelle tâche
                </a>
            </div>

            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($taches->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #e8f0fe;">
                                <tr>
                                    <th>Titre</th>
                                    <th>Assigné à</th>
                                    <th>Deadline</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($taches as $tache)
                                <tr>
                                    <td><strong>{{ $tache->titre }}</strong></td>
                                    <td>{{ $tache->assigne->name }}</td>
                                    <td>
                                        <span class="small {{ $tache->est_en_retard ? 'text-danger fw-bold' : '' }}">
                                            {{ Carbon\Carbon::parse($tache->deadline)->format('d/m/Y') }}
                                            @if($tache->est_en_retard)
                                                <i class="fas fa-exclamation-triangle ms-1"></i>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if($tache->statut == 'todo')
                                            <span class="badge rounded-pill px-3 py-2" style="background: #ffc107; color: #000;">À faire</span>
                                        @elseif($tache->statut == 'doing')
                                            <span class="badge rounded-pill px-3 py-2" style="background: #0dcaf0;">En cours</span>
                                        @else
                                            <span class="badge rounded-pill px-3 py-2" style="background: #198754;">Terminée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('manager.tache.show', $tache->id) }}" class="btn btn-sm rounded-pill px-3" style="background: #1e3a5f; color: white;">
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
                        <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucune tâche</p>
                        <a href="{{ route('manager.tache.create') }}" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white;">
                            <i class="fas fa-plus me-2"></i> Créer une tâche
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
