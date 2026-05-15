{{-- resources/views/employe/competences.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Mes compétences')

@section('content')
<style>
    body { background: #f0f4f8 !important; }

    .page-header {
        background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 28px;
        color: white;
    }

    .progress-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        margin-bottom: 24px;
        border: 1px solid #e8edf2;
    }

    .progress-bar-custom {
        background: linear-gradient(90deg, #10b981, #06b6d4);
        border-radius: 10px;
        height: 10px;
        transition: width 0.4s ease;
    }

    .category-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        margin-bottom: 24px;
        border: 1px solid #e8edf2;
        overflow: hidden;
    }

    .category-header {
        background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
        padding: 16px 24px;
        color: white;
    }

    .skill-card {
        border: 1.5px solid #e8edf2;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        background: #fafbfc;
        transition: all 0.2s ease;
    }

    .skill-card:hover {
        border-color: #4f46e5;
        box-shadow: 0 4px 16px rgba(79,70,229,0.08);
        transform: translateY(-1px);
    }

    /* Radio buttons stylisés SANS JS */
    .level-options {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 12px;
    }

    .level-option input[type="radio"] {
        display: none;
    }

    .level-option label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        cursor: pointer;
        background: white;
        transition: all 0.2s ease;
    }

    .level-option label:hover {
        border-color: #4f46e5;
        background: #f5f3ff;
        transform: translateY(-2px);
    }

    .level-option input[type="radio"]:checked + label {
        border-color: #4f46e5;
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        box-shadow: 0 4px 12px rgba(79,70,229,0.2);
    }

    .level-option input[type="radio"]:checked + label .level-num {
        color: #4f46e5;
    }

    .level-num {
        font-size: 1.4rem;
        font-weight: 800;
        color: #9ca3af;
        line-height: 1;
    }

    .level-name {
        font-size: 0.62rem;
        color: #9ca3af;
        margin-top: 4px;
        text-align: center;
        font-weight: 500;
    }

    .level-option input[type="radio"]:checked + label .level-name {
        color: #4f46e5;
    }

    /* Couleurs par niveau */
    .level-option:nth-child(1) input:checked + label { border-color: #06b6d4; background: #ecfeff; }
    .level-option:nth-child(1) input:checked + label .level-num,
    .level-option:nth-child(1) input:checked + label .level-name { color: #06b6d4; }

    .level-option:nth-child(2) input:checked + label { border-color: #10b981; background: #ecfdf5; }
    .level-option:nth-child(2) input:checked + label .level-num,
    .level-option:nth-child(2) input:checked + label .level-name { color: #10b981; }

    .level-option:nth-child(3) input:checked + label { border-color: #f59e0b; background: #fffbeb; }
    .level-option:nth-child(3) input:checked + label .level-num,
    .level-option:nth-child(3) input:checked + label .level-name { color: #f59e0b; }

    .level-option:nth-child(4) input:checked + label { border-color: #8b5cf6; background: #f5f3ff; }
    .level-option:nth-child(4) input:checked + label .level-num,
    .level-option:nth-child(4) input:checked + label .level-name { color: #8b5cf6; }

    .level-option:nth-child(5) input:checked + label { border-color: #ef4444; background: #fef2f2; }
    .level-option:nth-child(5) input:checked + label .level-num,
    .level-option:nth-child(5) input:checked + label .level-name { color: #ef4444; }

    .badge-critique {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        font-size: 0.7rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    .actions-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        border: 1px solid #e8edf2;
        margin-top: 8px;
    }

    .btn-save {
        background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(30,58,95,0.3);
        color: white;
    }
</style>

<div class="container py-4">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="fas fa-star me-2" style="color: #fbbf24;"></i>
                    Mes compétences
                </h2>
                <p class="mb-0 opacity-75">
                    Évaluez votre niveau pour chaque compétence (1 à 5). Votre manager devra valider vos choix.
                </p>
            </div>
            <span class="badge p-2 px-3" style="background: rgba(255,255,255,0.2); font-size: 0.85rem; border-radius: 20px;">
                <i class="fas fa-clock me-1"></i> En attente de validation
            </span>
        </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @php
        $groupes = $competences->groupBy('categorie');
        $totalCompetences = $competences->count();
        $evaluees = 0;
        foreach ($competences as $c) {
            if (($mesCompetences[$c->id] ?? 0) > 0) $evaluees++;
        }
        $pourcentage = $totalCompetences > 0 ? round(($evaluees / $totalCompetences) * 100) : 0;
    @endphp

    {{-- Barre de progression --}}
    <div class="progress-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-semibold text-secondary small">
                <i class="fas fa-tasks me-1"></i> Progression de l'auto-évaluation
            </span>
            <span class="fw-bold" style="color: #1e3a5f;">{{ $pourcentage }}%</span>
        </div>
        <div class="progress mb-2" style="height: 10px; border-radius: 10px; background: #e8edf2;">
            <div class="progress-bar-custom" style="width: {{ $pourcentage }}%;"></div>
        </div>
        <small class="text-muted">
            <i class="fas fa-check-circle me-1 text-success"></i>
            {{ $evaluees }} / {{ $totalCompetences }} compétences évaluées
        </small>
    </div>

    <form method="POST" action="{{ route('employe.competences.update') }}">
        @csrf
        @method('PUT')

        @foreach ($groupes as $categorie => $comps)
            <div class="category-card">

                {{-- Category Header --}}
                <div class="category-header">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-folder-open me-2"></i>
                        {{ $categorie ?: 'Autres compétences' }}
                        <span class="badge ms-2"
                              style="background: rgba(255,255,255,0.2); font-weight: 500; border-radius: 20px;">
                            {{ $comps->count() }} compétence(s)
                        </span>
                    </h5>
                </div>

                <div class="p-4">
                    @foreach ($comps as $competence)
                        @php $niveauActuel = $mesCompetences[$competence->id] ?? 0; @endphp

                        <div class="skill-card">
                            {{-- Skill Header --}}
                            <div class="d-flex align-items-start justify-content-between flex-wrap gap-2 mb-1">
                                <h6 class="fw-bold mb-0">
                                    {{ $competence->nom }}
                                    @if ($competence->is_critique)
                                        <span class="badge-critique ms-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Critique
                                        </span>
                                    @endif
                                </h6>
                                @if ($niveauActuel > 0)
                                    <span class="badge" style="background: #e0e7ff; color: #4f46e5; border-radius: 20px; font-size: 0.75rem;">
                                        Niveau {{ $niveauActuel }} sélectionné
                                    </span>
                                @endif
                            </div>

                            @if ($competence->description)
                                <p class="text-muted small mb-3">{{ $competence->description }}</p>
                            @endif

                            {{-- Level Options --}}
                            <div class="level-options">
                                @foreach ([1 => 'Notions', 2 => 'Débutant', 3 => 'Intermédiaire', 4 => 'Avancé', 5 => 'Expert'] as $niveau => $label)
                                    <div class="level-option">
                                        <input
                                            type="radio"
                                            name="competences[{{ $competence->id }}]"
                                            id="skill_{{ $competence->id }}_{{ $niveau }}"
                                            value="{{ $niveau }}"
                                            {{ $niveauActuel == $niveau ? 'checked' : '' }}
                                        >
                                        <label for="skill_{{ $competence->id }}_{{ $niveau }}">
                                            <span class="level-num">{{ $niveau }}</span>
                                            <span class="level-name">{{ $label }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        {{-- Actions --}}
        <div class="actions-card">
            <div class="alert border-0 rounded-3 mb-4"
                 style="background: #eff6ff; border-left: 4px solid #3b82f6 !important; border-left-style: solid !important;">
                <div class="d-flex gap-3">
                    <i class="fas fa-info-circle fa-lg mt-1" style="color: #3b82f6;"></i>
                    <div>
                        <strong style="color: #1e40af;">Information</strong>
                        <p class="mb-0 small text-muted mt-1">
                            Votre manager recevra une notification pour valider vos niveaux.
                            Vous pourrez modifier vos réponses jusqu'à validation.
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap gap-3">
                <a href="{{ route('employe.dashboard') }}" class="btn btn-outline-secondary rounded-3 px-4">
                    <i class="fas fa-arrow-left me-2"></i> Retour au tableau de bord
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save me-2"></i> Enregistrer mon auto-évaluation
                </button>
            </div>
        </div>

    </form>
</div>
@endsection
