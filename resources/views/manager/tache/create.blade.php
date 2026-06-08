<x-app-layout>
    {{-- Formulaire de creation des taches --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-plus-circle fs-4 me-3"></i>
                            <h4 class="mb-0 fw-bold">Créer une tâche</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('manager.tache.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Titre</label>
                                <input type="text" name="titre" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control rounded-3" rows="3"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Assigner à</label>
                                        <select name="assignee_a" class="form-select rounded-3" required>
                                            <option value="">Sélectionner un employé</option>
                                            @foreach($employes as $employe)
                                                <option value="{{ $employe->id }}">{{ $employe->name }} ({{ $employe->poste ?? 'Employé' }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Projet (optionnel)</label>
                                        <select name="projet_id" class="form-select rounded-3">
                                            <option value="">Aucun projet</option>
                                            @foreach($projets as $projet)
                                                <option value="{{ $projet->id }}">{{ $projet->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Durée estimée (jours)</label>
                                        <input type="number" name="duree_estimee" class="form-control rounded-3" min="1" value="1" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Deadline</label>
                                        <input type="date" name="deadline" class="form-control rounded-3" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <a href="{{ route('manager.tache.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i> Annuler
                                </a>
                                <button type="submit" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white;">
                                    <i class="fas fa-save me-2"></i> Créer la tâche
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
