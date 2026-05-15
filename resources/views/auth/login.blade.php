<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - HR-Smart</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
        }

        .full-page {
            min-height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="full-page">
        <div class="row g-0 h-100">

            <!-- Colonne gauche - Formulaire -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-3 p-md-4"
                style="background: white; min-height: 100vh;">
                <div class="w-100" style="max-width: 400px;">

                    <!-- Logo et titre -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <svg viewBox="0 0 100 100" width="50" height="50" style="display: inline-block;">
                                <path d="M68.1 24.9L50.1 14.3 32 24.9 32 46.3 50.1 56.9 68.1 46.3 68.1 24.9z"
                                    fill="#FF2D20" />
                                <path d="M50.1 56.9L32 46.3 32 67.7 50.1 78.3 68.1 67.7 68.1 46.3 50.1 56.9z"
                                    fill="#FF2D20" opacity="0.8" />
                                <path d="M50.1 78.3L32 67.7 32 89.2 50.1 99.7 68.1 89.2 68.1 67.7 50.1 78.3z"
                                    fill="#FF2D20" opacity="0.6" />
                                <path d="M86.2 35.5L68.1 24.9 68.1 46.3 86.2 56.9 86.2 35.5z" fill="#FF2D20"
                                    opacity="0.5" />
                                <path d="M86.2 56.9L68.1 46.3 68.1 67.7 86.2 78.3 86.2 56.9z" fill="#FF2D20"
                                    opacity="0.3" />
                            </svg>
                        </div>
                        <h3 class="fw-bold mb-1">HR-Smart</h3>
                        <p class="text-muted small">Plateforme RH intelligente</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
                            <i class="bi bi-check-circle me-1"></i> {{ session('status') }}
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show py-2 small" role="alert">
                            <i class="bi bi-exclamation-triangle me-1"></i> Identifiants invalides
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-semibold mb-1">
                                <i class="bi bi-envelope me-1"></i> Email professionnel
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autofocus class="form-control form-control-sm @error('email') is-invalid @enderror"
                                placeholder="nom@entreprise.com">
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-semibold mb-1">
                                <i class="bi bi-lock me-1"></i> Mot de passe
                            </label>
                            <input type="password" id="password" name="password" required
                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                placeholder="••••••••">
                            @error('password')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Se souvenir de moi -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label small text-secondary" for="remember_me">
                                Se souvenir de moi
                            </label>
                        </div>

                        <!-- Boutons -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-sm fw-semibold py-2">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                Se connecter
                            </button>
                        </div>

                        <!-- Liens -->
                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                    <i class="bi bi-question-circle me-1"></i> Mot de passe oublié ?
                                </a>
                            @endif
                        </div>

                        <!-- Lien vers inscription -->
                        <div class="text-center mt-4 pt-2 border-top">
                            <p class="small text-muted mb-0">
                                Pas encore de compte ?
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                    S'inscrire
                                </a>
                            </p>
                        </div>

                    </form>

                    <!-- Message sécurité -->
                    <div class="text-center mt-4 pt-2 border-top">
                        <small class="text-muted small">
                            <i class="bi bi-shield-check me-1"></i>
                            Connexion sécurisée
                        </small>
                    </div>

                </div>
            </div>

            <!-- Colonne droite - Héros -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center text-white p-4"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
                <div class="text-center">
                    <i class="bi bi-building fs-1 mb-3 d-block"></i>
                    <h2 class="fw-bold mb-2 display-5">HR-Smart</h2>
                    <p class="mb-3">La solution complète pour votre RH</p>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center gap-4">
                            <div>
                                <i class="bi bi-people fs-4"></i>
                                <p class="small mt-1 mb-0">Gestion des employés</p>
                            </div>
                            <div>
                                <i class="bi bi-calendar fs-4"></i>
                                <p class="small mt-1 mb-0">Congés & Absences</p>
                            </div>
                            <div>
                                <i class="bi bi-graph-up fs-4"></i>
                                <p class="small mt-1 mb-0">Performances</p>
                            </div>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="mt-5 pt-3">
                        <hr class="bg-white-50">

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
