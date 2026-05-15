{{-- resources/views/manager/conge/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Demandes de congé')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>
                <i class="fas fa-calendar-check text-primary"></i>
                Demandes de congé
            </h1>
            <p class="text-muted">Gérez les demandes de congé de votre équipe.</p>
            <hr>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-clock"></i> Demandes en attente</h5>
        </div>
        <div class="card-body">

            @if($demandes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-light">
                                <th>Employé</th>
                                <th>Période</th>
                                <th>Durée</th>
                                <th>Type</th>
                                <th>Date demande</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($demandes as $demande)
                            <tr>
                                <td>
                                    <strong>{{ $demande->user->name }}</strong><br>
                                    <small class="text-muted">{{ $demande->user->poste ?? 'Poste non défini' }}</small>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}<br>
                                    <small class="text-muted">→ {{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</small>
                                </td>
                                <td>{{ $demande->duree }} jours</td>
                                <td>
                                    @switch($demande->type)
                                        @case('vacances') 🏖️ Vacances @break
                                        @case('maladie') 🤒 Maladie @break
                                        @case('personnel') 👤 Personnel @break
                                        @case('formation') 📚 Formation @break
                                    @endswitch
                                </td>
                                <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('manager.conges.show', $demande->id) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Traiter
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <p class="text-muted">Aucune demande de congé en attente</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
