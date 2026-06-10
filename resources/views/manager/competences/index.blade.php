<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">📋 Validation des compétences</h4>
            </div>
            <div class="card-body p-4">
                @if($employes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #e8f0fe;">
                                <tr>
                                    <th>Employé</th>
                                    <th>Email</th>
                                    <th>Compétences</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employes as $employe)
                                <tr>
                                    <td><strong>{{ $employe->name }}</strong></td>
                                    <td>{{ $employe->email }}</td>
                                    <td>
                                        @php
                                            $nonValidees = $employe->competences()->wherePivot('validee', false)->count();
                                        @endphp
                                        <span class="badge rounded-pill px-3 py-2" style="background: #ffc107; color: #000;">
                                            {{ $nonValidees }} en attente
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('manager.competences.show', $employe->id) }}" 
                                           class="btn btn-sm rounded-pill px-3" style="background: #1e3a5f; color: white;">
                                            <i class="fas fa-eye me-1"></i> Valider
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <p class="text-muted">Aucun employé dans votre équipe</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>