<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                        <h4 class="mb-0 fw-bold">Nouveau projet</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('manager.projet.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nom du projet</label>
                                <input type="text" name="nom" class="form-control rounded-3" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control rounded-3" rows="3"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date début</label>
                                        <input type="date" name="date_debut" class="form-control rounded-3" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date fin </label>
                                        <input type="date" name="date_fin" class="form-control rounded-3">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Budget prévisionnel (DH)</label>
                                <input type="number" name="budget_previsionnel" class="form-control rounded-3" step="0.01" value="0">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Équipe projet</label>
                                <select name="employes[]" class="form-select rounded-3" multiple size="5">
                                    @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}">
                                            {{ $employe->name }} ({{ $employe->poste ?? 'Employé' }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Ctrl+clic pour sélectionner plusieurs employés</small>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('manager.projet.index') }}" class="btn btn-outline-secondary rounded-pill">
                                    <i class="fas fa-arrow-left me-2"></i> Annuler
                                </a>
                                <button type="submit" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white;">
                                    <i class="fas fa-save me-2"></i> Créer le projet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
