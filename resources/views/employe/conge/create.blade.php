{{-- resources/views/employe/conge/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Demander un congé')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-calendar-plus"></i> Demander un congé</h4>
                    </div>
                    <div class="card-body">

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Congés restants : <strong>{{ $congesRestants }} jours</strong>
                        </div>

                        <form method="POST" action="{{ route('employe.conge.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Type de congé</label>
                                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="vacances">Vacances</option>
                                    <option value="maladie">Maladie</option>
                                    <option value="personnel">Personnel</option>
                                    <option value="formation">Formation</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date de début</label>
                                        <input type="date" name="date_debut"
                                            class="form-control @error('date_debut') is-invalid @enderror" required>
                                        @error('date_debut')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date de fin</label>
                                        <input type="date" name="date_fin"
                                            class="form-control @error('date_fin') is-invalid @enderror" required>
                                        @error('date_fin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Motif (optionnel)</label>
                                <textarea name="motif" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('employe.dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Envoyer la demande
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
