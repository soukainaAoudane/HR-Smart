<x-app-layout>
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: #1e3a5f;">
                <h4 class="mb-0 fw-bold">👥 Gestion des employés</h4>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead style="background-color: #e8f0fe;">
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Manager actuel</th>
                                <th>Assigner un manager</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employes as $employe)
                            <form action="{{ route('admin.employes.updateManager', $employe->id) }}" method="POST">
                                @csrf
                                <tr>
                                    <td>{{ $employe->name }}</td>
                                    <td>{{ $employe->email }}</td>
                                    <td>
                                        @if($employe->manager)
                                            {{ $employe->manager->name }}
                                        @else
                                            <span class="text-muted">Non assigné</span>
                                        @endif
                                    </td>
                                    <td>
                                        <select name="manager_id" class="form-select form-select-sm" style="width: auto; display: inline-block;">
                                            <option value="">-- Aucun manager --</option>
                                            @foreach($managers as $manager)
                                                <option value="{{ $manager->id }}" {{ $employe->manager_id == $manager->id ? 'selected' : '' }}>
                                                    {{ $manager->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-sm rounded-pill px-3" style="background: #1e3a5f; color: white;">
                                            <i class="fas fa-save me-1"></i> Assigner
                                        </button>
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
