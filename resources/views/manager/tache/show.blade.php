<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fs-4 me-3"></i>
                            <h4 class="mb-0 fw-bold">Détail de la tâche</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">

                        <div class="alert mb-4 rounded-3 text-center fw-bold fs-5 
                            @if($tache->statut == 'todo') alert-warning text-dark
                            @elseif($tache->statut == 'doing') alert-info
                            @else alert-success @endif">
                            @if($tache->statut == 'todo')
                                📌 Statut : À faire
                            @elseif($tache->statut == 'doing')
                                🔄 Statut : En cours
                            @else
                                ✅ Statut : Terminée
                            @endif
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">Titre</small>
                                    <span class="fw-bold fs-5">{{ $tache->titre }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">Assigné à</small>
                                    <span class="fw-bold fs-5">{{ $tache->assigne->name }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <small class="text-muted text-uppercase d-block mb-1">Description</small>
                                    <p class="mb-0">{{ $tache->description ?? 'Aucune description' }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">Projet</small>
                                    <span>{{ $tache->projet->nom ?? 'Aucun projet' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">Durée estimée</small>
                                    <span>{{ $tache->duree_estimee }} jours</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">Deadline</small>
                                    <span class="{{ $tache->est_en_retard ? 'text-danger fw-bold' : '' }}">
                                        {{ Carbon\Carbon::parse($tache->deadline)->format('d/m/Y') }}
                                        @if($tache->est_en_retard)
                                            <i class="fas fa-exclamation-triangle ms-1"></i> (En retard)
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <a href="{{ route('manager.tache.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Retour
                            </a>
                            <div>
                                <a href="{{ route('manager.tache.edit', $tache->id) }}" class="btn rounded-pill px-4" style="background: #ffc107; color: #000;">
                                    <i class="fas fa-edit me-2"></i> Modifier
                                </a>
                                <form action="{{ route('manager.tache.destroy', $tache->id) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Supprimer cette tâche ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                                        <i class="fas fa-trash-alt me-2"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>