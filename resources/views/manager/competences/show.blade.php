<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">✏️ Validation des compétences - {{ $employe->name }}</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead style="background-color: #e8f0fe;">
                            <tr>
                                <th>Compétence</th>
                                <th>Niveau proposé</th>
                                <th>Niveau validé</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($competences as $competence)
                            <tr>
                                <td><strong>{{ $competence->nom }}</strong></td>
                                <td>{{ $competence->pivot->niveau }} / 5</td>
                                <td>
                                    <form action="{{ route('manager.competences.refuser', [$employe->id, $competence->id]) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        <select name="niveau" class="form-select form-select-sm" style="width: auto; display: inline-block;">
                                            @for($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" {{ $competence->pivot->niveau == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-warning rounded-pill">
                                            <i class="fas fa-edit me-1"></i> Modifier
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    @if($competence->pivot->validee)
                                        <span class="badge rounded-pill" style="background: #198754;">
                                            <i class="fas fa-check-circle me-1"></i> Validée
                                        </span>
                                    @else
                                        <span class="badge rounded-pill" style="background: #ffc107; color: #000;">
                                            <i class="fas fa-clock me-1"></i> En attente
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$competence->pivot->validee)
                                        <form action="{{ route('manager.competences.valider', [$employe->id, $competence->id]) }}" 
                                              method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm rounded-pill px-3" style="background: #1e3a5f; color: white;">
                                                <i class="fas fa-check me-1"></i> Valider
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-success">✓</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('manager.competences.index') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>