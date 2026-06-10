<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">Propositions de remplacement</h4>
            </div>
            <div class="card-body p-4">

                @if($propositions->count() > 0)
                    <div class="alert alert-success mb-4">
                        <i class="fas fa-check-circle me-2"></i>
                        Congé de <strong>{{ $conge->user->name }}</strong> accepté.
                        Voici les meilleurs remplaçants :
                    </div>

                    <div class="row">
                        @foreach($propositions as $proposition)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="fw-bold mb-0">{{ $proposition['employe']->name }}</h5>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #1e3a5f;">
                                                Score: {{ $proposition['score'] }}%
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-briefcase me-1"></i>
                                            {{ $proposition['employe']->poste ?? 'Employé' }}
                                        </p>

                                        {{-- Barres de progression --}}
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Compétences</span>
                                                <span>{{ $proposition['details']['competences'] }}%</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-info" style="width: {{ $proposition['details']['competences'] }}%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Disponibilité</span>
                                                <span>{{ $proposition['details']['disponibilite'] }}%</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-success" style="width: {{ $proposition['details']['disponibilite'] }}%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Charge actuelle</span>
                                                <span>{{ $proposition['details']['charge'] }}%</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-warning" style="width: {{ $proposition['details']['charge'] }}%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span>Performance</span>
                                                <span>{{ $proposition['details']['performance'] }}%</span>
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-danger" style="width: {{ $proposition['details']['performance'] }}%"></div>
                                            </div>
                                        </div>

                                        <form action="{{ route('manager.conge.proposer', $conge->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="remplacant_id" value="{{ $proposition['employe']->id }}">
                                            <button type="submit" class="btn w-100 rounded-pill" style="background: #1e3a5f; color: white;">
                                                <i class="fas fa-paper-plane me-2"></i> Proposer ce remplaçant
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun remplaçant disponible pour ce congé.</p>
                        <a href="{{ route('manager.conges.index') }}" class="btn btn-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i> Retour
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
