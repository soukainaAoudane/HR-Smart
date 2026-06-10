<x-app-layout>
    {{-- Affichage d'un mono congé --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Détail de la demande</h4>
                    </div>
                    <div class="card-body">

                        {{-- Infos employé --}}
                        <div class="alert alert-info">
                            <strong>Employé :</strong> {{ $demande->user->name }}<br>
                            <strong>Email :</strong> {{ $demande->user->email }}<br>
                            <strong>Congés restants :</strong>
                            <span class="badge bg-primary">{{ $demande->user->conges_restants }} jours</span>
                        </div>

                        {{-- Infos congé --}}
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 150px;">Type</th>
                                <td>
                                    @if ($demande->type == 'paye')
                                        Congé payé
                                    @elseif($demande->type == 'rtt')
                                        RTT
                                    @elseif($demande->type == 'sans_solde')
                                        Congé sans solde
                                    @elseif($demande->type == 'formation')
                                        Congé formation
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Date début</th>
                                <td>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Date fin</th>
                                <td>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Durée</th>
                                <td>{{ $demande->duree }} jours</td>
                            </tr>
                            @if ($demande->motif)
                                <tr>
                                    <th>Motif</th>
                                    <td>{{ $demande->motif }}</td>
                                </tr>
                            @endif
                            <tr class="table-warning">
                                <th>Impact équipe</th>
                                <td>
                                    <strong>{{ $congesSimultanes }}/{{ $totalEquipe }}</strong> employés absents
                                    ({{ number_format($impactPourcentage, 0) }}%)
                                    @if ($impactPourcentage > 30)
                                        <span class="badge bg-danger ms-2">Attention</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        {{-- BOUTONS --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('manager.conges.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <div>
                                {{-- Accepter --}}
                                <form method="POST" action="{{ route('manager.conges.accepter', $demande->id) }}"
                                    style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Accepter cette demande ?')">
                                        <i class="fas fa-check-circle"></i> Accepter
                                    </button>
                                </form>

                                {{-- Refuser (ouvre modal) --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalRefus">
                                    <i class="fas fa-times-circle"></i> Refuser
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL REFUS --}}
    <div class="modal fade" id="modalRefus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('manager.conges.refuser', $demande->id) }}">
                    @csrf
                    @method('POST')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Refuser le congé</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Motif du refus <span class="text-danger">*</span></label>
                            <textarea name="motif_refus" class="form-control" rows="3" required placeholder="Expliquez la raison du refus..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Confirmer le refus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
