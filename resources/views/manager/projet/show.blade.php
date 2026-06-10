<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">Détail du projet - {{ $projet->nom }}</h4>
            </div>
            <div class="card-body p-4">

                {{-- Informations projet --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background: #e8f0fe;">
                            <small class="text-muted">Description</small>
                            <p class="mb-0">{{ $projet->description ?: 'Aucune description' }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: #e8f0fe;">
                            <small class="text-muted">Période</small>
                            <p class="mb-0">{{ \Carbon\Carbon::parse($projet->date_debut)->format('d/m/Y') }}
                                @if($projet->date_fin) → {{ \Carbon\Carbon::parse($projet->date_fin)->format('d/m/Y') }} @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: #e8f0fe;">
                            <small class="text-muted">Budget</small>
                            <p class="mb-0">{{ number_format($projet->budget_previsionnel, 2) }} DH</p>
                            @if($projet->budget_reel > 0)
                                <small class="text-muted">Réel: {{ number_format($projet->budget_reel, 2) }} DH</small>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Avancement --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <strong>Avancement du projet</strong>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Progression</span>
                            <span class="fw-bold">{{ $projet->avancement }}%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: {{ $projet->avancement }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Équipe --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <strong>Équipe projet</strong>
                    </div>
                    <div class="card-body">
                        @if($projet->employes->count() > 0)
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($projet->employes as $employe)
                                    <span class="badge rounded-pill px-3 py-2" style="background: #1e3a5f;">
                                        {{ $employe->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Aucun membre dans l'équipe</p>
                        @endif
                    </div>
                </div>

                {{-- Tâches liées --}}
                <div class="card mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <strong>Tâches du projet</strong>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjoutTache">
                            <i class="fas fa-plus"></i> Ajouter une tâche
                        </button>
                    </div>
                    <div class="card-body">
                        @if($taches->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Assigné à</th>
                                            <th>Deadline</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($taches as $tache)
                                        <tr>
                                            <td>{{ $tache->titre }}</td>
                                            <td>{{ $tache->assigne->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tache->deadline)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($tache->statut == 'todo') <span class="badge bg-warning">À faire</span>
                                                @elseif($tache->statut == 'doing') <span class="badge bg-info">En cours</span>
                                                @else <span class="badge bg-success">Terminée</span> @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Aucune tâche pour ce projet</p>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('manager.projet.index') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i> Retour
                    </a>
                    <a href="{{ route('manager.projet.edit', $projet->id) }}" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white;">
                        <i class="fas fa-edit me-2"></i> Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ajout Tâche --}}
    <div class="modal fade" id="modalAjoutTache" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('manager.projet.addTache', $projet->id) }}" method="POST">
                    @csrf
                    <div class="modal-header" style="background: #1e3a5f; color: white;">
                        <h5 class="modal-title">Ajouter une tâche</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Assigner à</label>
                            <select name="assignee_a" class="form-select" required>
                                <option value="">Sélectionner</option>
                                @foreach($projet->employes as $employe)
                                    <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Durée (jours)</label>
                                    <input type="number" name="duree_estimee" class="form-control" min="1" value="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Deadline</label>
                                    <input type="date" name="deadline" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn" style="background: #1e3a5f; color: white;">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
