<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-edit fs-4 me-3"></i>
                            <h4 class="mb-0 fw-bold">Modifier la tâche</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('manager.tache.update', $tache->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold">Titre</label>
                                <input type="text" name="titre" class="form-control rounded-3" value="{{ $tache->titre }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control rounded-3" rows="3">{{ $tache->description }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Assigner à</label>
                                        <select name="assignee_a" class="form-select rounded-3" required>
                                            @foreach($employes as $employe)
                                                <option value="{{ $employe->id }}" {{ $tache->assignee_a == $employe->id ? 'selected' : '' }}>
                                                    {{ $employe->name }} ({{ $employe->poste ?? 'Employé' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Projet</label>
                                        <select name="projet_id" class="form-select rounded-3">
                                            <option value="">Aucun projet</option>
                                            @foreach($projets as $projet)
                                                <option value="{{ $projet->id }}" {{ $tache->projet_id == $projet->id ? 'selected' : '' }}>
                                                    {{ $projet->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Durée estimée (jours)</label>
                                        <input type="number" name="duree_estimee" class="form-control rounded-3" min="1" value="{{ $tache->duree_estimee }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Deadline</label>
                                        <input type="date" name="deadline" class="form-control rounded-3" value="{{ $tache->deadline->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Statut</label>
                                        <select name="statut" class="form-select rounded-3">
                                            <option value="todo" {{ $tache->statut == 'todo' ? 'selected' : '' }}>📌 À faire</option>
                                            <option value="doing" {{ $tache->statut == 'doing' ? 'selected' : '' }}>🔄 En cours</option>
                                            <option value="done" {{ $tache->statut == 'done' ? 'selected' : '' }}>✅ Terminée</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <a href="{{ route('manager.tache.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i> Annuler
                                </a>
                                <button type="submit" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white;">
                                    <i class="fas fa-save me-2"></i> Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>