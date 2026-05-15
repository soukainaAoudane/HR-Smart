{{-- resources/views/manager/conge/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Détail demande de congé')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-alt"></i> Détail de la demande</h4>
                </div>
                <div class="card-body">

                    {{-- Informations employé --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-user"></i> Employé
                                    </h5>
                                    <p class="mb-1"><strong>Nom :</strong> {{ $demande->user->name }}</p>
                                    <p class="mb-1"><strong>Email :</strong> {{ $demande->user->email }}</p>
                                    <p class="mb-1"><strong>Poste :</strong> {{ $demande->user->poste ?? 'Non défini' }}</p>
                                    <p class="mb-0"><strong>Manager :</strong> {{ $demande->user->manager->name ?? 'Non assigné' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-chart-line"></i> Situation
                                    </h5>
                                    <p class="mb-1"><strong>Congés restants :</strong> {{ $demande->user->conges_restants }} jours</p>
                                    <p class="mb-1"><strong>Charge actuelle :</strong> {{ $demande->user->charge_actuelle }}%</p>
                                    <div class="progress mt-1">
                                        @php
                                            $chargeClass = $demande->user->charge_actuelle > 120 ? 'bg-danger' :
                                                           ($demande->user->charge_actuelle > 90 ? 'bg-warning' : 'bg-success');
                                        @endphp
                                        <div class="progress-bar {{ $chargeClass }}"
                                             style="width: {{ min($demande->user->charge_actuelle, 100) }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Détails du congé --}}
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Détails du congé</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Type :</strong>
                                        @switch($demande->type)
                                            @case('vacances') 🏖️ Vacances @break
                                            @case('maladie') 🤒 Maladie @break
                                            @case('personnel') 👤 Personnel @break
                                            @case('formation') 📚 Formation @break
                                        @endswitch
                                    </p>
                                    <p><strong>Date début :</strong> {{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</p>
                                    <p><strong>Date fin :</strong> {{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</p>
                                    <p><strong>Durée :</strong> {{ $demande->duree }} jours</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Motif :</strong></p>
                                    <p class="text-muted">{{ $demande->motif ?: 'Aucun motif fourni' }}</p>
                                    @if($demande->justificatif)
                                        <a href="{{ asset('storage/' . $demande->justificatif) }}" class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-file"></i> Voir justificatif
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Impact sur l'équipe --}}
                    <div class="alert alert-info">
                        <h5><i class="fas fa-users"></i> Impact sur l'équipe</h5>
                        <p class="mb-0">
                            Congés simultanés : <strong>{{ $congesSimultanes }}/{{ $totalEquipe }}</strong> employés
                            ({{ number_format($impactPourcentage, 0) }}% d'absents)
                        </p>
                        @if($impactPourcentage > 30)
                            <p class="text-danger mt-2 mb-0">
                                ⚠️ Attention : Plus de 30% de l'équipe sera absente simultanément !
                            </p>
                        @endif
                    </div>

                    {{-- Formulaire de validation --}}
                    <div class="card mt-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-gavel"></i> Décision</h5>
                        </div>
                        <div class="card-body">

                            {{-- Formulaire Acceptation --}}
                            <form method="POST" action="{{ route('manager.conges.accepter', $demande->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg"
                                        onclick="return confirm('Accepter cette demande de congé ?')">
                                    <i class="fas fa-check-circle"></i> Accepter
                                </button>
                            </form>

                            {{-- Formulaire Refus --}}
                            <button type="button" class="btn btn-danger btn-lg ms-2" data-bs-toggle="modal" data-bs-target="#modalRefus">
                                <i class="fas fa-times-circle"></i> Refuser
                            </button>

                            <a href="{{ route('manager.conges.index') }}" class="btn btn-secondary btn-lg ms-2 float-end">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de refus --}}
<div class="modal fade" id="modalRefus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('manager.conges.refuser', $demande->id) }}">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-times-circle"></i> Refuser le congé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="motif_refus" class="form-label">Motif du refus <span class="text-danger">*</span></label>
                        <textarea name="motif_refus" id="motif_refus" class="form-control" rows="4" required></textarea>
                        <small class="text-muted">Ce motif sera envoyé à l'employé.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Confirmer le refus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
