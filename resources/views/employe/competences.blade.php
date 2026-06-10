{{-- resources/views/employe/competences.blade.php --}}
<x-app-layout>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="text-white p-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #1e3a5f 0%, #0f2b3d 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-1">
                                <i class="fas fa-star me-2"></i> Mes compétences
                            </h2>
                            <p class="mb-0 opacity-75">
                                Évaluez votre niveau pour chaque compétence (1 à 5). Votre manager devra valider vos choix.
                            </p>
                        </div>
                        <div>
                            <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                <i class="fas fa-chart-line me-1"></i> Auto-évaluation
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('employe.competences.update') }}" method="POST" id="competenceForm">
            @csrf
            @method('PUT')

            @php
                $groupes = $competences->groupBy('categorie');
            @endphp

            @foreach ($groupes as $categorie => $comps)
                <div class="card mb-4 rounded-4 shadow-sm border-0">
                    <div class="card-header rounded-top-4 text-white fw-bold" style="background: #1e3a5f; border-bottom: none;">
                        <i class="fas fa-folder-open me-2"></i> {{ $categorie ?: 'Autres compétences' }}
                    </div>
                    <div class="card-body">
                        @foreach ($comps as $competence)
                            @php
                                $niveauActuel = $mesNiveaux[$competence->id] ?? 0;
                            @endphp
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5 class="fw-bold mb-0" style="color: #1e3a5f;">
                                                <i class="fas fa-code me-2"></i> {{ $competence->nom }}
                                            </h5>
                                            @if($competence->description)
                                                <small class="text-muted">{{ $competence->description }}</small>
                                            @endif
                                        </div>
                                        @if($competence->is_critique)
                                            <span class="badge rounded-pill px-3 py-2" style="background: #dc3545;">
                                                <i class="fas fa-exclamation-triangle me-1"></i> Critique
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Boutons radio stylisés --}}
                                    <div class="d-flex flex-wrap gap-2">
                                        <label class="radio-card {{ $niveauActuel == 1 ? 'selected' : '' }}" data-niveau="1">
                                            <input type="radio" name="competences[{{ $competence->id }}]" value="1" {{ $niveauActuel == 1 ? 'checked' : '' }} class="d-none">
                                            <div class="radio-content text-center">
                                                <span class="radio-number fw-bold fs-5">1</span>
                                                <span class="radio-label d-block small">Notions</span>
                                            </div>
                                        </label>
                                        <label class="radio-card {{ $niveauActuel == 2 ? 'selected' : '' }}" data-niveau="2">
                                            <input type="radio" name="competences[{{ $competence->id }}]" value="2" {{ $niveauActuel == 2 ? 'checked' : '' }} class="d-none">
                                            <div class="radio-content text-center">
                                                <span class="radio-number fw-bold fs-5">2</span>
                                                <span class="radio-label d-block small">Débutant</span>
                                            </div>
                                        </label>
                                        <label class="radio-card {{ $niveauActuel == 3 ? 'selected' : '' }}" data-niveau="3">
                                            <input type="radio" name="competences[{{ $competence->id }}]" value="3" {{ $niveauActuel == 3 ? 'checked' : '' }} class="d-none">
                                            <div class="radio-content text-center">
                                                <span class="radio-number fw-bold fs-5">3</span>
                                                <span class="radio-label d-block small">Intermédiaire</span>
                                            </div>
                                        </label>
                                        <label class="radio-card {{ $niveauActuel == 4 ? 'selected' : '' }}" data-niveau="4">
                                            <input type="radio" name="competences[{{ $competence->id }}]" value="4" {{ $niveauActuel == 4 ? 'checked' : '' }} class="d-none">
                                            <div class="radio-content text-center">
                                                <span class="radio-number fw-bold fs-5">4</span>
                                                <span class="radio-label d-block small">Avancé</span>
                                            </div>
                                        </label>
                                        <label class="radio-card {{ $niveauActuel == 5 ? 'selected' : '' }}" data-niveau="5">
                                            <input type="radio" name="competences[{{ $competence->id }}]" value="5" {{ $niveauActuel == 5 ? 'checked' : '' }} class="d-none">
                                            <div class="radio-content text-center">
                                                <span class="radio-number fw-bold fs-5">5</span>
                                                <span class="radio-label d-block small">Expert</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-between mt-4 pt-3">
                <a href="{{ route('employe.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Annuler
                </a>
                <button type="submit" class="btn rounded-pill px-4" style="background: #1e3a5f; color: white; border: none;">
                    <i class="fas fa-save me-2"></i> Enregistrer mes compétences
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<style>
    .radio-card {
        flex: 1;
        min-width: 60px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .radio-card .radio-content {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 12px;
        padding: 10px 5px;
        transition: all 0.2s ease;
    }
    
    .radio-card:hover .radio-content {
        border-color: #1e3a5f;
        background: #e8f0fe;
        transform: translateY(-2px);
    }
    
    .radio-card.selected .radio-content {
        background: #1e3a5f;
        border-color: #1e3a5f;
        color: white;
        box-shadow: 0 4px 12px rgba(30, 58, 95, 0.3);
    }
    
    .radio-card.selected .radio-number,
    .radio-card.selected .radio-label {
        color: white;
    }
    
    .radio-number {
        color: #1e3a5f;
    }
    
    .radio-label {
        color: #6c757d;
        font-size: 0.7rem;
    }
    
    @media (max-width: 768px) {
        .radio-card {
            min-width: 50px;
        }
        
        .radio-label {
            font-size: 0.6rem;
        }
        
        .radio-number {
            font-size: 0.9rem;
        }
    }
</style>

<script>
    // Gestion des clics sur les boutons radio stylisés
    document.querySelectorAll('.radio-card').forEach(card => {
        card.addEventListener('click', function() {
            const parent = this.closest('.d-flex');
            const radio = this.querySelector('input[type="radio"]');
            
            // Désélectionner tous les radios du même groupe
            parent.querySelectorAll('.radio-card').forEach(c => {
                c.classList.remove('selected');
            });
            
            // Sélectionner celui-ci
            this.classList.add('selected');
            radio.checked = true;
        });
    });
</script>