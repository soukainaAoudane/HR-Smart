{{-- resources/views/employe/deplacement/show.blade.php --}}
<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fs-4 me-3"></i>
                            <h4 class="mb-0 fw-bold">Détail du déplacement</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">

                        {{-- Statut en évidence --}}
                        <div class="alert mb-4 rounded-3 text-center fw-bold fs-5
                            @if($deplacement->statut == 'pending') alert-warning text-dark
                            @elseif($deplacement->statut == 'approved') alert-success
                            @else alert-danger @endif">
                            <i class="fas
                                @if($deplacement->statut == 'pending') fa-clock
                                @elseif($deplacement->statut == 'approved') fa-check-circle
                                @else fa-times-circle @endif me-2"></i>
                            @if($deplacement->statut == 'pending')
                                En attente de validation
                            @elseif($deplacement->statut == 'approved')
                                Déplacement accepté
                            @else
                                Déplacement refusé
                            @endif
                        </div>

                        <div class="row g-3">
                            {{-- Période --}}
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-calendar-alt me-1"></i> Peeriode
                                    </small>
                                    <span class="fw-bold fs-5">
                                        {{ \Carbon\Carbon::parse($deplacement->date_debut)->format('d/m/Y') }}
                                    </span>
                                    <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                    <span class="fw-bold fs-5">
                                        {{ \Carbon\Carbon::parse($deplacement->date_fin)->format('d/m/Y') }}
                                    </span>
                                    <br>
                                    <small class="text-muted">
                                        Durée : {{ \Carbon\Carbon::parse($deplacement->date_debut)->diffInDays(\Carbon\Carbon::parse($deplacement->date_fin)) + 1 }} jours
                                    </small>
                                </div>
                            </div>

                            {{-- Lieu --}}
                            <div class="col-md-6">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-map-marker-alt me-1"></i> Lieu
                                    </small>
                                    <span class="fw-bold fs-5">
                                        <i class="fas fa-location-dot me-2" style="color: #1e3a5f;"></i>
                                        {{ $deplacement->lieu }}
                                    </span>
                                </div>
                            </div>

                            {{-- Client --}}
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 border">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-building me-1"></i> rganisation
                                    </small>
                                    <span class="fw-bold">
                                        {{ $deplacement->client ?? 'Non spécifié' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Motif --}}
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #f8f9fa;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-edit me-1"></i> Motif
                                    </small>
                                    <p class="mb-0">{{ $deplacement->motif ?? 'Non spécifié' }}</p>
                                </div>
                            </div>

                            {{-- Frais --}}
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-coins me-1"></i> Frais estiméss
                                    </small>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <div class="text-center p-2 bg-white rounded-3">
                                                <i class="fas fa-car text-primary"></i>
                                                <div class="fw-bold">{{ number_format($deplacement->frais_transport, 2) }} DH</div>
                                                <small class="text-muted">Transport</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center p-2 bg-white rounded-3">
                                                <i class="fas fa-hotel text-primary"></i>
                                                <div class="fw-bold">{{ number_format($deplacement->frais_hebergement, 2) }} DH</div>
                                                <small class="text-muted">Hébergement</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center p-2 bg-white rounded-3">
                                                <i class="fas fa-utensils text-primary"></i>
                                                <div class="fw-bold">{{ number_format($deplacement->frais_repas, 2) }} DH</div>
                                                <small class="text-muted">Repas</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2 pt-2 border-top">
                                        <strong class="fs-5" style="color: #198754;">
                                            Total : {{ number_format($deplacement->frais_total, 2) }} DH
                                        </strong>
                                    </div>
                                </div>
                            </div>

                            {{-- Commentaire manager --}}
                            @if($deplacement->commentaire_manager)
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #fff3cd; border-left: 4px solid #ffc107;">
                                    <small class="text-warning text-uppercase d-block mb-1">
                                        <i class="fas fa-comment-dots me-1"></i> Commentaire du manager
                                    </small>
                                    <p class="mb-0">{{ $deplacement->commentaire_manager }}</p>
                                </div>
                            </div>
                            @endif

                            {{-- Justificatif --}}
                            @if($deplacement->justificatif)
                            <div class="col-12">
                                <div class="p-3 rounded-3" style="background: #e8f0fe;">
                                    <small class="text-muted text-uppercase d-block mb-1">
                                        <i class="fas fa-paperclip me-1"></i> Justificatif
                                    </small>
                                    <a href="{{ asset('storage/' . $deplacement->justificatif) }}" target="_blank"
                                        class="btn rounded-pill px-3" style="background: #1e3a5f; color: white; border: none;">
                                        <i class="fas fa-file-pdf me-2"></i> Voir le fichier
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <a href="{{ route('employe.deplacement.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Retour
                            </a>
                            @if($deplacement->statut == 'pending')
                                <form action="{{ route('employe.deplacement.destroy', $deplacement->id) }}"
                                    method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                                        <i class="fas fa-trash-alt me-2"></i> Annuler
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .rounded-3 {
        border-radius: 0.75rem !important;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .border {
        border-color: #e9ecef !important;
    }

    .btn {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }
</style>
