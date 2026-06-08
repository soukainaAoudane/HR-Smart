{{-- resources/views/employe/profil.blade.php --}}
<x-app-layout>
    {{-- Profile --}}
    <div class="container py-4">
        <h1 class="text-center  fw-bold mb-4"style="color: #1e3a5f;">
            Mon Profil
        </h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row g-4">
            {{-- nftmations personnelles --}}
            <div class="col-lg-6 col-12">
                <div class="card shadow-sm border-0 rounded-4 h-100">

                    <div class="card-header bg-white border-0 text-center pt-4">
                        <h4 class="mt-3 fw-bold">
                            {{ $user->name }}
                        </h4>
                        <span class="badge bg-primary">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="border rounded-4 p-4 bg-light">
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">
                                    Nom
                                </div>
                                <div class="col-8">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">
                                    Email
                                </div>
                                <div class="col-8">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">
                                    Roole
                                </div>
                                <div class="col-8">
                                    {{ ucfirst($user->role) }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">
                                    Manager
                                </div>
                                <div class="col-8">
                                    {{ $manager?->name ?? 'Aucun manager' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 fw-bold">
                                    Poste
                                </div>
                                <div class="col-8">
                                    {{ $user->poste }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modidification du profil --}}
            <div class="col-lg-6 col-12">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="fw-bold  mb-0" style="color: #1e3a5f;">
                            Modifier mon profil
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employe.profil.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    Nom
                                </label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    Email
                                </label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-semibold">
                                    Mot de passe actuel
                                </label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    Nouveau mot de passe
                                </label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Poste
                                </label>
                                <input type="text" class="form-control" value="{{ $user->poste }}" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                Enregistrer les modifications
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
