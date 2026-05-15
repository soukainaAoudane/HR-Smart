{{-- resources/views/employe/conge/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Détail du congé')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-info-circle"></i> Détail de ma demande</h4>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Statut :</div>
                            <div class="col-md-8">
                                @if ($conge->statut == 'pending')
                                    <span class="badge bg-warning text-dark">⏳ En attente de validation</span>
                                @elseif($conge->statut == 'approved')
                                    <span class="badge bg-success">✅ Accepté</span>
                                @else
                                    <span class="badge bg-danger">❌ Refusé</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Type :</div>
                            <div class="col-md-8">
                                @switch($conge->type)
                                    @case('vacances')
                                        🏖️ Vacances
                                    @break

                                    @case('maladie')
                                        🤒 Maladie
                                    @break

                                    @case('personnel')
                                        👤 Personnel
                                    @break

                                    @case('formation')
                                        📚 Formation
                                    @break

                                    @default
                                        {{ $conge->type }}
                                @endswitch
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Période :</div>
                            <div class="col-md-8">
                                Du {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}<br>
                                Au {{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Durée :</div>
                            <div class="col-md-8">{{ $conge->duree }} jours</div>
                        </div>

                        @if ($conge->motif)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Motif :</div>
                                <div class="col-md-8">{{ $conge->motif }}</div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Date de demande :</div>
                            <div class="col-md-8">{{ $conge->created_at->format('d/m/Y à H:i') }}</div>
                        </div>

                        @if ($conge->commentaire_manager)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Commentaire manager :</div>
                                <div class="col-md-8">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-comment"></i> {{ $conge->commentaire_manager }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('employe.conge.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour à la liste
                            </a>

                            @if ($conge->statut == 'pending')
                                <form method="POST" action="{{ route('employe.conge.annuler', $conge->id) }}"
                                    onsubmit="return confirm('Annuler cette demande ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Annuler la demande
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
