<x-guest-layout>
    <div class="full-page">
        <div class="row g-0 h-100">

            <!-- Colonne gauche - Formulaire -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-3 p-md-4"
                style="background: white; min-height: 100vh;">
                <div class="w-100" style="max-width: 400px;">

                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <svg viewBox="0 0 100 100" width="50" height="50" style="display: inline-block;">
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

                    <h3 class="fw-bold text-center mb-2">Mot de passe oublié ?</h3>
                    <p class="text-muted text-center small mb-4">
                        Entrez votre adresse email et nous vous enverrons un lien de réinitialisation.
                    </p>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
                            <i class="bi bi-check-circle me-1"></i> {{ session('status') }}
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label small fw-semibold mb-1">
                                <i class="bi bi-envelope me-1"></i> Adresse email
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autofocus class="form-control form-control-sm @error('email') is-invalid @enderror"
                                placeholder="exemple@email.com">
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm fw-semibold py-2">
                                <i class="bi bi-envelope-paper me-1"></i>
                                Envoyer le lien de réinitialisation
                            </button>
                        </div>

                        <!-- Lien retour -->
                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="text-decoration-none small">
                                <i class="bi bi-arrow-left me-1"></i> Retour à la connexion
                            </a>
                        </div>

                    </form>

                    <!-- Message sécurité -->
                    <div class="text-center mt-4 pt-2 border-top">
                        <small class="text-muted small">
                            <i class="bi bi-shield-check me-1"></i>
                            Lien valable 60 minutes
                        </small>
                    </div>

                </div>
            </div>

            <!-- Colonne droite - Héros -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center text-white p-4"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
                <div class="text-center">
                    <i class="bi bi-key fs-1 mb-3 d-block"></i>
                    <h2 class="fw-bold mb-2 display-5">HR-Smart</h2>
                    <p class="mb-3">Récupérez l'accès à votre compte</p>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center gap-4">
                            <div>
                                <i class="bi bi-shield-lock fs-4"></i>
                                <p class="small mt-1 mb-0">Sécurisé</p>
                            </div>
                            <div>
                                <i class="bi bi-clock-history fs-4"></i>
                                <p class="small mt-1 mb-0">Rapide</p>
                            </div>
                            <div>
                                <i class="bi bi-envelope-check fs-4"></i>
                                <p class="small mt-1 mb-0">Fiable</p>
                            </div>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="mt-5 pt-3">
                        <hr class="bg-white-50">
                        <div class="mt-3">
                            <small class="opacity-75">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Un lien vous sera envoyé par email
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
