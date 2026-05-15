<x-guest-layout>
    <div class="full-page">
        <div class="row g-0 h-100">

            <!-- Colonne gauche - Formulaire -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-3 p-md-4"
                style="background: white; min-height: 100vh;">
                <div class="w-100" style="max-width: 400px;">

                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <svg viewBox="0 0 100 100" width="45" height="45" style="display: inline-block;">
                            <path d="M68.1 24.9L50.1 14.3 32 24.9 32 46.3 50.1 56.9 68.1 46.3 68.1 24.9z"
                                fill="#FF2D20" />
                            <path d="M50.1 56.9L32 46.3 32 67.7 50.1 78.3 68.1 67.7 68.1 46.3 50.1 56.9z" fill="#FF2D20"
                                opacity="0.8" />
                            <path d="M50.1 78.3L32 67.7 32 89.2 50.1 99.7 68.1 89.2 68.1 67.7 50.1 78.3z" fill="#FF2D20"
                                opacity="0.6" />
                            <path d="M86.2 35.5L68.1 24.9 68.1 46.3 86.2 56.9 86.2 35.5z" fill="#FF2D20"
                                opacity="0.5" />
                            <path d="M86.2 56.9L68.1 46.3 68.1 67.7 86.2 78.3 86.2 56.9z" fill="#FF2D20"
                                opacity="0.3" />
                        </svg>
                    </div>

                    <h3 class="fw-bold text-center mb-1">Nouveau mot de passe</h3>
                    <p class="text-muted text-center mb-4 small">Choisissez un mot de passe sécurisé</p>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        <input type="hidden" name="email" value="{{ request()->email }}">

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-semibold mb-1">
                                <i class="bi bi-envelope me-1"></i> Email
                            </label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', request()->email) }}"
                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                placeholder="exemple@email.com" required readonly>
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-semibold mb-1">
                                <i class="bi bi-lock me-1"></i> Nouveau mot de passe
                            </label>
                            <input type="password" id="password" name="password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                placeholder="8 caractères min" required>
                            @error('password')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                            <div class="form-text small mt-1">
                                <i class="bi bi-info-circle me-1"></i> Minimum 8 caractères
                            </div>
                        </div>

                        <!-- Confirmation -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label small fw-semibold mb-1">
                                <i class="bi bi-check-circle me-1"></i> Confirmer
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirmez" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-sm fw-semibold py-1">
                                <i class="bi bi-arrow-repeat me-1"></i>
                                Réinitialiser
                            </button>
                        </div>

                        <!-- Lien retour -->
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none small">
                                ← Retour
                            </a>
                        </div>

                    </form>

                    <!-- Message sécurité -->
                    <div class="text-center mt-3 pt-2 border-top">
                        <small class="text-muted small">
                            <i class="bi bi-shield-check me-1"></i>
                            Lien valable 60 min
                        </small>
                    </div>

                </div>
            </div>

            <!-- Colonne droite - Héros -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center text-white p-4"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
                <div class="text-center">
                    <i class="bi bi-shield-lock fs-1 mb-3 d-block"></i>
                    <h2 class="fw-bold mb-2">HR-Smart</h2>
                    <p class="mb-0 small">Gestion RH simplifiée</p>
                    <div class="mt-4">

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
