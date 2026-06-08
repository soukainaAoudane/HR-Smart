<x-app-layout>
    {{-- Affichages des taâches --}}
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f; border-bottom: none;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-tasks fs-4 me-3"></i>
                    <h4 class="mb-0 fw-bold">Mes tâches</h4>
                </div>
            </div>
            <div class="card-body p-4">
                @if ($taches->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead style="background-color: #e8f0fe;">
                                <tr>
                                    <th>Titre</th>
                                    <th>Deadline</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taches as $tache)
                                    <tr>
                                        <td><strong>{{ $tache->titre }}</strong><br>
                                            <small
                                                class="text-muted">{{ $tache->description ?? 'Pas de descprotion' }}</small>
                                        </td>
                                        <td>
                                            <span
                                                class="small {{ $tache->est_en_retard ? 'text-danger fw-bold' : '' }}">
                                                {{ Carbon\Carbon::parse($tache->deadline)->format('d/m/Y') }}
                                                @if ($tache->est_en_retard)
                                                    <i class="fas fa-exclamation-triangle ms-1"></i>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            @if ($tache->statut == 'todo')
                                                <span class="badge rounded-pill px-3 py-2"
                                                    style="background: #ffc107; color: #000;">À faire</span>
                                            @elseif($tache->statut == 'doing')
                                                <span class="badge rounded-pill px-3 py-2"
                                                    style="background: #0dcaf0;">En cours</span>
                                            @else
                                                <span class="badge rounded-pill px-3 py-2"
                                                    style="background: #198754;">Terminée</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($tache->statut != 'done')
                                                <form action="{{ route('employe.tache.update', $tache->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="statut" class="form-select form-select-sm"
                                                        onchange="this.form.submit()"
                                                        style="width: auto; display: inline-block;">
                                                        <option value="todo"
                                                            {{ $tache->statut == 'todo' ? 'selected' : '' }}>À faire
                                                        </option>
                                                        <option value="doing"
                                                            {{ $tache->statut == 'doing' ? 'selected' : '' }}>En
                                                            cours</option>
                                                        <option value="done"
                                                            {{ $tache->statut == 'done' ? 'selected' : '' }}>Terminée
                                                        </option>
                                                    </select>
                                                </form>
                                            @else
                                                <span class="text-success">Terminée le
                                                    {{ Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <p class="text-muted">Aucune tâche assignée</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
