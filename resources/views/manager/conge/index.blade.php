{{-- resources/views/manager/conge/index.blade.php --}}
<x-app-layout>
    {{-- Affichage des congés --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary text-white" style="background: #1e3a5f">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Demandes de congé</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($demandes->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Employé</th>
                                            <th>Type</th>
                                            <th>Date début</th>
                                            <th>Date fin</th>
                                            <th>Durée</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($demandes as $index => $demande){
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $demande->user->name }}</strong><br>
                                                <small class="text-muted">{{ $demande->user->poste ?? 'Employé' }}</small>
                                            </td>
                                            <td>
                                                @if($demande->type == 'paye')
                                                    <span class="badge bg-info">Congé payé</span>
                                                @elseif($demande->type == 'rtt')
                                                    <span class="badge bg-success">RTT</span>
                                                @elseif($demande->type == 'sans_solde')
                                                    <span class="badge bg-warning">Sans solde</span>
                                                @elseif($demande->type == 'formation')
                                                    <span class="badge bg-primary">Formation</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary">{{ $demande->duree }} jourss</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning text-dark">En attente</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('manager.conges.show', $demande->id) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i> Traiter
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach}
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                <h5 class="text-muted">Aucune demande en attente</h5>
                                <p class="text-muted">Toutes les demandes ont été traitées.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
