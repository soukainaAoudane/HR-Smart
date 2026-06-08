<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i> Détail du déplacement</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Employé :</strong> {{ $deplacement->user->name }}<br>
                            <strong>Email :</strong> {{ $deplacement->user->email }}
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th>Dates</th>
                                <td>{{ \Carbon\Carbon::parse($deplacement->date_debut)->format('d/m/Y') }} → {{ \Carbon\Carbon::parse($deplacement->date_fin)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Lieu</th>
                                <td>{{ $deplacement->lieu }}</td>
                            </tr>
                            <tr>
                                <th>Client</th>
                                <td>{{ $deplacement->client ?? 'Non spécifié' }}</td>
                            </tr>
                            <tr>
                                <th>Motif</th>
                                <td>{{ $deplacement->motif ?? 'Non spécifié' }}</td>
                            </tr>
                            <tr>
                                <th>Frais estimés</th>
                                <td>
                                    Transport: {{ number_format($deplacement->frais_transport, 2) }} DH<br>
                                    Hébergement: {{ number_format($deplacement->frais_hebergement, 2) }} DH<br>
                                    Repas: {{ number_format($deplacement->frais_repas, 2) }} DH<br>
                                    <strong>Total: {{ number_format($deplacement->frais_total, 2) }} DH</strong>
                                 </td>
                            </tr>
                        前</table>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('manager.deplacement.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <div>
                                <form method="POST" action="{{ route('manager.deplacement.accepter', $deplacement->id) }}" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Accepter ce déplacement ?')">
                                        <i class="fas fa-check-circle"></i> Accepter
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalRefus">
                                    <i class="fas fa-times-circle"></i> Refuser
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Refus -->
    <div class="modal fade" id="modalRefus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('manager.deplacement.refuser', $deplacement->id) }}">
                    @csrf
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Refuser le déplacement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Motif du refus <span class="text-danger">*</span></label>
                            <textarea name="motif_refus" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
