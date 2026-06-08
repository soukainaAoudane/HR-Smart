{{-- resources/views/employe/deplacement/create.blade.php --}}
<x-app-layout>
    {{-- Formulaire e demander un deplacement --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-car fs-4 me-3"></i>
                            <h4 class="mb-0 fw-bold">Demander un déplacement</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('employe.deplacement.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="date_debut" class="form-control rounded-3" id="date_debut" required>
                                        <label for="date_debut"><i class="fas fa-calendar-day me-2"></i>Date début</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="date_fin" class="form-control rounded-3" id="date_fin" required>
                                        <label for="date_fin"><i class="fas fa-calendar-check me-2"></i>Date fin</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="form-floating">
                                    <input type="text" name="lieu" class="form-control rounded-3" id="lieu" placeholder="Ex: Casablanca" required>
                                    <label for="lieu"><i class="fas fa-map-marker-alt me-2"></i>Lieu</label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="form-floating">
                                    <input type="text" name="client" class="form-control rounded-3" id="client" placeholder="Nom du client">
                                    <label for="client"><i class="fas fa-building me-2"></i>Oorganisation</label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-edit me-2" style="color: #1e3a5f;"></i>Motif
                                </label>
                                <textarea name="motif" class="form-control rounded-3" rows="3" placeholder="Décriver le motif du déplacement"></textarea>
                            </div>

                            <div class="card mt-4 rounded-3 border-0 shadow-sm" style="background: #e8f0fe;">
                                <div class="card-header rounded-top-3" style="background: #1e3a5f; color: white; border: none;">
                                    <strong><i class="fas fa-coins me-2"></i> Frais estimeés</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text rounded-start-3" style="background: #1e3a5f; color: white; border: none;">
                                                    <i class="fas fa-car"></i>
                                                </span>
                                                <input type="number" name="frais_transport" class="form-control" step="0.01" value="0" placeholder="Transport">
                                                <span class="input-group-text rounded-end-3">dh</span>
                                            </div>
                                            <small class="text-muted ms-1">Frais de transport</small>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text rounded-start-3" style="background: #1e3a5f; color: white; border: none;">
                                                    <i class="fas fa-hotel"></i>
                                                </span>
                                                <input type="number" name="frais_hebergement" class="form-control" step="0.01" value="0" placeholder="Hébergement">
                                                <span class="input-group-text rounded-end-3">dh</span>
                                            </div>
                                            <small class="text-muted ms-1">Frais d'hébergements</small>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text rounded-start-3" style="background: #1e3a5f; color: white; border: none;">
                                                    <i class="fas fa-utensils"></i>
                                                </span>
                                                <input type="number" name="frais_repas" class="form-control" step="0.01" value="0" placeholder="Repas">
                                                <span class="input-group-text rounded-end-3">dh</span>
                                            </div>
                                            <small class="text-muted ms-1">Frais de repas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-file-pdf me-2" style="color: #1e3a5f;"></i>Justificatif
                                </label>
                                <div class="input-group">
                                    <input type="file" name="justificatif" class="form-control rounded-start-3" accept=".pdf,.doc,.docx">
                                    <span class="input-group-text rounded-end-3" style="background: #e8f0fe;">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i> PDF, DOC, DOCX
                                </small>
                            </div>

                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <a href="{{ route('employe.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i> Annuler
                                </a>
                                <button type="submit" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white; border: none;">
                                    <i class="fas fa-paper-plane me-2"></i> Envoyer la demande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .form-floating > .form-control {
        height: 58px;
        padding: 1rem 0.75rem;
    }

    .form-floating > label {
        padding: 1rem 0.75rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #1e3a5f;
        box-shadow: 0 0 0 0.2rem rgba(30, 58, 95, 0.25);
    }

    .rounded-3 {
        border-radius: 0.75rem !important;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .input-group-text {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }
</style>
