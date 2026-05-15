@extends('layouts.dashboard')

@section('title', 'Mon profil')

@section('content')
    <div class="container py-4">


        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            {{-- Colonne gauche : Formulaire --}}
            <div class="col-lg-6">

                {{-- Carte Informations --}}
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-circle text-primary me-2"></i>
                            Informations personnelles
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('employe.profil.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nom complet</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" name="name"
                                        class="form-control border-start-0 @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Adresse email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" name="email"
                                        class="form-control border-start-0 @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Poste</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-briefcase text-muted"></i>
                                    </span>
                                    <input disabled type="text" name="poste" class="form-control border-start-0"
                                        value="{{ old('poste', $user->poste) }}">
                                </div>
                            </div>





                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary rounded-pill py-2 fw-semibold">
                                    <i class="fas fa-save me-2"></i> Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {{-- Colonne droite : Statistiques --}}
            <div class="col-lg-6">

                {{-- Carte Récapitulatif --}}
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-chart-pie text-success me-2"></i>
                            Récapitulatif
                        </h5>
                    </div>
                    <div class="card-body p-4">

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-calendar-alt fa-2x text-primary mb-2"></i>
                                    <p class="text-muted small mb-0">Solde de congés</p>
                                    <h3 class="mb-0 fw-bold">{{ $user->conges_restants ?? 0 }}</h3>
                                    <small>jours restants</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                    <p class="text-muted small mb-0">En attente</p>
                                    <h3 class="mb-0 fw-bold">{{ $user->congesEnAttente()->count() ?? 0 }}</h3>
                                    <small>demandes</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <p class="text-muted small mb-0">Approuvés</p>
                                    <h3 class="mb-0 fw-bold">{{ $user->congesApprouves()->count() ?? 0 }}</h3>
                                    <small>congés validés</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 text-center">
                                    <i class="fas fa-chart-line fa-2x text-info mb-2"></i>
                                    <p class="text-muted small mb-0">Charge</p>
                                    <h3 class="mb-0 fw-bold">{{ $user->charge_actuelle ?? 0 }}%</h3>
                                    <small>travail</small>
                                </div>
                            </div>
                        </div>

                        @if ($user->isManager())
                            <hr class="my-4">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                        <p class="mb-0 fw-semibold">Équipe</p>
                                        <h4 class="mb-0">{{ $user->employes()->count() ?? 0 }} employés</h4>
                                    </div>
                                    <a href="{{ route('manager.conges.index') }}"
                                        class="btn btn-sm btn-primary rounded-pill">
                                        <i class="fas fa-calendar-check me-1"></i> Valider les congés
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Carte Informations complémentaires --}}
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-info-circle text-secondary me-2"></i>
                            Informations complémentaires
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-borderless">
                            <tr>
                                <td class="ps-0 text-muted" style="width: 120px;">Rôle :</td>
                                <td class="fw-semibold">
                                    <span class="badge bg-primary rounded-pill">{{ ucfirst($user->role) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-0 text-muted">Manager :</td>
                                <td class="fw-semibold">
                                    @if ($manager)
                                        {{ $manager->name?? 'Non assigné' }}
                                    @else
                                        <span class="text-muted">Aucun manager</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-0 text-muted">Date d'inscription :</td>
                                <td class="fw-semibold">{{ $user->created_at->format('d/m/Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
