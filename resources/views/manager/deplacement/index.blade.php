<x-app-layout>
    {{-- Afficher de deplacements --}}
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header  text-dark">
                <h4 class="mb-0"><i class="fas fa-plane me-2"></i> Demandes de déplacement</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($deplacements->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Employé</th>
                                    <th>Dates</th>
                                    <th>Lieu</th>
                                    <th>Frais</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deplacements as $deplacement)
                                <tr>
                                    <td><strong>{{ $deplacement->user->name }}</strong></td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($deplacement->date_debut)->format('d/m/Y') }}<br>
                                        <small>→ {{ \Carbon\Carbon::parse($deplacement->date_fin)->format('d/m/Y') }}</small>
                                    </td>
                                    <td>{{ $deplacement->lieu }}</td>
                                    <td>{{ number_format($deplacement->frais_total, 2) }} DH</td>
                                    <td>
                                        <a href="{{ route('manager.deplacement.show', $deplacement->id) }}" class="btn btn-sm btn-primary">
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
                        <p class="text-muted">Aucune demande en attente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
