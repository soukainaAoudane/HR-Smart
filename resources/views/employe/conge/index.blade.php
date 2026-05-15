@extends('layouts.dashboard')

@section('title', 'Mes congés')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-calendar-alt text-primary me-2"></i>
                Mes demandes de congés
            </h1>
            <a href="{{ route('employe.conge.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nouvelle demande
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($conges->isEmpty())
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="fas fa-calendar-day fa-4x text-muted mb-3"></i>
                    <h4>Aucune demande de congé</h4>
                    <p class="text-muted">Vous n'avez pas encore fait de demande de congé.</p>
                    <a href="{{ route('employe.conge.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Faire une demande
                    </a>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    @auth
                                        @if (auth()->user()->isManager())
                                            <th>Employé</th>
                                        @endif
                                    @endauth
                                    <th>Période</th>
                                    <th>Type</th>
                                    <th>Motif</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conges as $conge)
                                    <tr>
                                        @auth
                                            @if (auth()->user()->isManager())
                                                <td>{{ $conge->user->name }}</td>
                                            @endif
                                        @endauth
                                        <td>
                                            {{ $conge->date_debut->format('d/m/Y') }} -
                                            {{ $conge->date_fin->format('d/m/Y') }}
                                            <br>
                                            <small
                                                class="text-muted">{{ $conge->date_debut->diffInDays($conge->date_fin) + 1 }}
                                                jours</small>
                                        </td>
                                        <td>
                                            @switch($conge->type)
                                                @case('cp')
                                                    <span class="badge bg-info">Congés payés</span>
                                                @break

                                                @case('rtt')
                                                    <span class="badge bg-success">RTT</span>
                                                @break

                                                @case('sans_solde')
                                                    <span class="badge bg-warning">Sans solde</span>
                                                @break

                                                @case('maladie')
                                                    <span class="badge bg-danger">Maladie</span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">{{ $conge->type }}</span>
                                            @endswitch
                                        </td>
                                        <td>{{ $conge->motif }}</td>
                                        <td>
                                            @switch($conge->statut)
                                                @case('en_attente')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i> En attente
                                                    </span>
                                                @break

                                                @case('pending')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i> En attente
                                                    </span>
                                                @break

                                                @case('valide')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i> Validé
                                                    </span>
                                                @break

                                                @case('approved')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i> Approuvé
                                                    </span>
                                                @break

                                                @case('refuse')
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i> Refusé
                                                    </span>
                                                @break

                                                @case('rejected')
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i> Refusé
                                                    </span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">{{ $conge->statut }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            @auth
                                                @if (auth()->user()->isManager() && $conge->statut == 'pending')
                                                    <form action="{{ route('manager.conges.accepter', $conge->id) }}"
                                                        method="POST" class="d-inline me-2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-check"></i> Accepter
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#refuseModal{{ $conge->id }}">
                                                        <i class="fas fa-times"></i> Refuser
                                                    </button>

                                                    <!-- Modal de refus -->
                                                    <div class="modal fade" id="refuseModal{{ $conge->id }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Refuser la demande de congé</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <form
                                                                    action="{{ route('manager.conges.refuser', $conge->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="motif" class="form-label">Motif du
                                                                                refus</label>
                                                                            <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Refuser</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif (auth()->user()->isEmploye() && $conge->statut == 'pending')
                                                    <form action="{{ route('employe.conge.annuler', $conge->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Annuler cette demande ?')">
                                                            <i class="fas fa-trash"></i> Annuler
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            @endauth
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
