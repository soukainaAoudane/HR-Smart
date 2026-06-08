{{-- resources/views/employe/deplacement/index.blade.php --}}
<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4 d-flex justify-content-between align-items-center" style="background: #1e3a5f; border-bottom: none;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-plane fs-4 me-3"></i>
                    <h4 class="mb-0 fw-bold">Mes déplacements</h4>
                </div>
                <a href="{{ route('employe.deplacement.create') }}" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="fas fa-plus me-1"></i> Nouveau déplacement
                </a>
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

                @if($deplacements->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #e8f0fe; color: #1e3a5f;">
                                <tr>
                                    <th class="py-3">Dates</th>
                                    <th class="py-3">Lieu</th>
                                    <th class="py-3">Client</th>
                                    <th class="py-3">Frais</th>
                                    <th class="py-3">Statut</th>
                                    <th class="py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deplacements as $deplacement)
                                    <tr style="border-left: 4px solid
                                        @if($deplacement->statut == 'pending') #ffc107
                                        @elseif($deplacement->statut == 'approved') #198754
                                        @else #dc3545 @endif">
                                        <td>
                                            <span class="fw-semibold">{{ \Carbon\Carbon::parse($deplacement->date_debut)->format('d/m/Y') }}</span>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-arrow-right me-1"></i> 
                                                {{ \Carbon\Carbon::parse($deplacement->date_fin)->format('d/m/Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            <i class="fas fa-map-marker-alt me-1" style="color: #1e3a5f;"></i>
                                            {{ $deplacement->lieu }}
                                        </td>
                                        <td>
                                            @if($deplacement->client)
                                                <i class="fas fa-building me-1 text-muted"></i>
                                                {{ $deplacement->client }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-semibold" style="color: #198754;">
                                                {{ number_format($deplacement->frais_total, 2) }} DH
                                            </span>
                                        </td>
                                        <td>
                                            @if($deplacement->statut == 'pending')
                                                <span class="badge rounded-pill px-3 py-2" style="background: #ffc107; color: #000;">
                                                    <i class="fas fa-clock me-1"></i> En attente
                                                </span>
                                            @elseif($deplacement->statut == 'approved')
                                                <span class="badge rounded-pill px-3 py-2" style="background: #198754;">
                                                    <i class="fas fa-check-circle me-1"></i> Accepté
                                                </span>
                                            @else
                                                <span class="badge rounded-pill px-3 py-2" style="background: #dc3545;">
                                                    <i class="fas fa-times-circle me-1"></i> Refusé
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('employe.deplacement.show', $deplacement->id) }}" 
                                               class="btn btn-sm rounded-pill px-3" 
                                               style="background: #1e3a5f; color: white; border: none;">
                                                <i class="fas fa-eye me-1"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center p-4" style="width: 100px; height: 100px;">
                                <i class="fas fa-plane fa-3x" style="color: #1e3a5f;"></i>
                            </div>
                        </div>
                        <h5 class="text-muted">Aucun déplacement demandé</h5>
                        <p class="text-muted">Vous n'avez pas encore fait de demande de déplacement.</p>
                        <a href="{{ route('employe.deplacement.create') }}" class="btn rounded-pill px-4 mt-2" 
                           style="background: #1e3a5f; color: white; border: none;">
                            <i class="fas fa-plus me-2"></i> Demander un déplacement
                        </a>
                    </div>
                @endif
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
        cursor: pointer;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
    .badge {
        font-weight: 500;
        font-size: 0.75rem;
    }
    
    .btn {
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        filter: brightness(1.05);
    }
    
    @media (max-width: 768px) {
        .table td, .table th {
            font-size: 0.8rem;
            padding: 10px 8px;
        }
        
        .badge {
            font-size: 0.65rem;
            padding: 4px 8px;
        }
        
        .btn-sm {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }
    }
</style>