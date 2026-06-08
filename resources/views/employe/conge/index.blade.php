{{-- resources/views/employe/conge/index.blade.php --}}
<x-app-layout>
    {{-- Affichage des congéées --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-calendar-alt me-2"></i> Mes demandes de congés
                            </h4>
                            <a href="{{ route('employe.conge.create') }}" class="btn btn-light btn-sm rounded-pill px-3">
                                <i class="fas fa-plus me-1"></i> Nouvelle demande
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
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

                        @if($conges->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead style="background-color: #e8f0fe; color: #1e3a5f;">
                                        <tr>
                                            <th class="py-3">#</th>
                                            <th class="py-3">Type de congé</th>
                                            <th class="py-3">Date début</th>
                                            <th class="py-3">Date fin</th>
                                            <th class="py-3">Durée</th>
                                            <th class="py-3">Statut</th>
                                            <th class="py-3">Motif</th>
                                            <th class="py-3 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($conges as $index => $conge)
                                            <tr style="border-left: 4px solid {{ $conge->statut == 'pending' ? '#ffc107' : ($conge->statut == 'approved' ? '#198754' : '#dc3545') }}">
                                                <td class="fw-bold">{{ $index + 1 }}</td>
                                                <td>
                                                    @if($conge->type == 'paye')
                                                        <span class="badge rounded-pill px-3 py-2" style="background: #1e3a5f;">
                                                            <i class="fas fa-umbrella-beach me-1"></i> Congé payé
                                                        </span>
                                                    @elseif($conge->type == 'rtt')
                                                        <span class="badge rounded-pill px-3 py-2" style="background: #198754;">
                                                            <i class="fas fa-bolt me-1"></i> RTT
                                                        </span>
                                                    @elseif($conge->type == 'sans_solde')
                                                        <span class="badge rounded-pill px-3 py-2" style="background: #fd7e14;">
                                                            <i class="fas fa-coins me-1"></i> Sans solde
                                                        </span>
                                                    @elseif($conge->type == 'formation')
                                                        <span class="badge rounded-pill px-3 py-2" style="background: #0dcaf0;">
                                                            <i class="fas fa-graduation-cap me-1"></i> Formation
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-muted">{{ $conge->date_debut->format('d/m/Y') }}</td>
                                                <td class="text-muted">{{ $conge->date_fin->format('d/m/Y') }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary rounded-pill px-3 py-2">
                                                        {{ $conge->duree }} jour(s)
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($conge->statut == 'pending')
                                                        <span class="badge rounded-pill px-3 py-2" style="background: #ffc107; color: #000;">
                                                            <i class="fas fa-clock me-1"></i> En attente
                                                        </span>
                                                    @elseif($conge->statut == 'approved')
                                                        <span class="badge rounded-pill px-3 py-2" style="background: #198754;">
                                                            <i class="fas fa-check-circle me-1"></i> Approuvé
                                                        </span>
                                                    @elseif($conge->statut == 'refused')
                                                        <span class="badge rounded-pill px-3 py-2" style="background: #dc3545;">
                                                            <i class="fas fa-times-circle me-1"></i> Refusé
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill"
                                                            data-bs-toggle="tooltip" title="{{ $conge->motif }}">
                                                        <i class="fas fa-eye me-1"></i> Voir
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('employe.conge.show', $conge->id) }}"
                                                           class="btn btn-sm btn-outline-primary rounded-pill me-1">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                        @if($conge->statut == 'pending')
                                                            <form action="{{ route('employe.conge.annuler', $conge->id) }}"
                                                                  method="POST" class="d-inline"
                                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if(method_exists($conges, 'links'))
                                <div class="mt-4 d-flex justify-content-center">
                                    {{ $conges->links() }}
                                </div>
                            @endif

                        @else
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-4" style="width: 100px; height: 100px;">
                                        <i class="fas fa-calendar-week fa-3x" style="color: #1e3a5f;"></i>
                                    </div>
                                </div>
                                <h5 class="text-muted">Aucune demande de congé</h5>
                                <p class="text-muted">Vous n'avez pas encore fait de demande de congé.</p>
                                <a href="{{ route('employe.conge.create') }}" class="btn btn-primary rounded-pill px-4 mt-2"
                                   style="background: #1e3a5f; border: none;">
                                    <i class="fas fa-plus me-2"></i> Faire une demande
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .table {
        border-radius: 12px;
        overflow: hidden;
    }

    .table thead th {
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .badge {
        font-weight: 500;
    }

    .btn-group .btn {
        transition: all 0.2s ease;
    }

    .btn-group .btn:hover {
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .table td, .table th {
            font-size: 0.8rem;
            padding: 10px 8px;
        }

        .badge {
            font-size: 0.7rem;
            padding: 4px 8px;
        }

        .btn-sm {
            padding: 0.2rem 0.4rem;
        }
    }
</style>

<script>
    // Activer les tooltips Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
