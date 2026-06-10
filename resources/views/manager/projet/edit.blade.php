<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                        <h4 class="mb-0 fw-bold">Modifier le projet</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('manager.projet.update', $projet->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nom du projet</label>
                                <input type="text" name="nom" class="form-control rounded-3" value="{{ $projet->nom }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control rounded-3" rows="3">{{ $projet->description }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date début</label>
                                        <input type="date" name="date_debut" class="form-control rounded-3" value="{{ $projet->date_debut->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date fin</label>
                                        <input type="date" name="date_fin" class="form-control rounded-3" value="{{ $projet->date_fin ? $projet->date_fin->format('Y-m-d') : '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Budget prévisionnel (DH)</label>
                                        <input type="number" name="budget_previsionnel" class="form-control rounded-3" step="0.01" value="{{ $projet->budget_previsionnel }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Budget réel (DH)</label>
                                        <input type="number" name="budget_reel" class="form-control rounded-3" step="0.01" value="{{ $projet->budget_reel }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Statut</label>
                                <select name="statut" class="form-select rounded-3">
                                    <option value="en_attente" {{ $projet->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en_cours" {{ $projet->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="termine" {{ $projet->statut == 'termine' ? 'selected' : '' }}>Terminé</option>
                                    <option value="annule" {{ $projet->statut == 'annule' ? 'selected' : '' }}>Annulé</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Équipe projet</label>
                                <select name="employes[]" class="form-select rounded-3" multiple size="5">
                                    @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}" {{ in_array($employe->id, $employesIds) ? 'selected' : '' }}>
                                            {{ $employe->name }} ({{ $employe->poste ?? 'Employé' }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Ctrl+clic pour sélectionner/désélectionner</small>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('manager.projet.show', $projet->id) }}" class="btn btn-outline-secondary rounded-pill">
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
