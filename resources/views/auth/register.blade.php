<x-guest-layout>
    <!-- PARTIE GAUCHE - FORMULAIRE SCROLLABLE (défile) -->
    <div class="scrollable-form">
        <div class="form-content">
            <div class="form-container">


                <form method="POST" action="{{ route('register') }}" x-data="{
                    showPassword: false,
                    showConfirmPassword: false,
                    password: '',
                    confirmPassword: ''
                }">
                    @csrf

                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
                            <i class="bi bi-person me-1"></i> Nom complet
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            autofocus class="form-control @error('name') is-invalid @enderror"
                            placeholder="Jean Dupont"
                            style="border-color: #748cab;">
                        @error('name')
                            <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
                            <i class="bi bi-envelope me-1"></i> Adresse email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="form-control @error('email') is-invalid @enderror" placeholder="nom@entreprise.com"
                            style="border-color: #748cab;">
                        @error('email')
                            <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Rôle -->
                    <div class="mb-3">
                        <label for="role" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
                            <i class="bi bi-briefcase me-1"></i> Rôle
                        </label>
                        <select id="role" name="role" required
                            class="form-select @error('role') is-invalid @enderror"
                            style="border-color: #748cab;">
                            <option value="employe" {{ old('role') == 'employe' ? 'selected' : '' }}>Employé</option>
                            <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
                            <i class="bi bi-lock me-1"></i> Mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" x-bind:type="showPassword ? 'text' : 'password'" id="password"
                                name="password" required x-model="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="8 caractères minimum"
                                style="border-color: #748cab;">
                            <button class="btn btn-outline-secondary" type="button"
                                x-on:click="showPassword = !showPassword"
                                style="border-color: #748cab;">
                                <i class="bi" x-bind:class="showPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                            </button>
                        </div>
                        <div class="form-text small mt-1" style="color: #748cab;">
                            <i class="bi bi-info-circle me-1"></i> Minimum 8 caractères
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmation -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small fw-semibold mb-2" style="color: #0d1321;">
                            <i class="bi bi-check-circle me-1"></i> Confirmer le mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" x-bind:type="showConfirmPassword ? 'text' : 'password'"
                                id="password_confirmation" name="password_confirmation" required
                                x-model="confirmPassword"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirmez votre mot de passe"
                                style="border-color: #748cab;">
                            <button class="btn btn-outline-secondary" type="button"
                                x-on:click="showConfirmPassword = !showConfirmPassword"
                                style="border-color: #748cab;">
                                <i class="bi" x-bind:class="showConfirmPassword ? 'bi-eye-slash' : 'bi-eye'"></i>
                            </button>
                        </div>
                        <!-- Message de confirmation en direct -->
                        <div class="small mt-1" x-show="confirmPassword.length > 0" x-cloak>
                            <template x-if="password === confirmPassword && password.length > 0">
                                <span class="text-success">
                                    <i class="bi bi-check-circle-fill me-1"></i> Les mots de passe correspondent
                                </span>
                            </template>
                            <template x-if="password !== confirmPassword && confirmPassword.length > 0">
                                <span class="text-danger">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Les mots de passe ne
                                    correspondent pas
                                </span>
                            </template>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ optionnel pour tester le scroll -->
                    <div class="mb-4">
                        <label class="form-label small fw-semibold mb-2" style="color: #748cab;">
                            <i class="bi bi-building me-1"></i> Entreprise (optionnel)
                        </label>
                        <input type="text" class="form-control" placeholder="Nom de votre entreprise"
                            style="border-color: #748cab;">
                    </div>

                    <!-- Bouton -->
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-custom fw-semibold py-2">
                            <i class="bi bi-person-plus me-2"></i>
                            S'inscrire
                        </button>
                    </div>

                    <!-- Lien connexion -->
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none small" style="color: #3e5c76;">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Déjà inscrit ? Se connecter
                        </a>
                    </div>

                </form>

                <!-- Sécurité -->
                <div class="text-center mt-4 pt-2 border-top" style="border-color: #748cab;">
                    <small style="color: #748cab;">
                        <i class="bi bi-shield-check me-1"></i>
                        Vos données sont sécurisées
                    </small>
                </div>

                <!-- Indicateur de scroll -->
                <div class="text-center mt-5 pt-3">
                    <small style="color: #748cab;">
                        <i class="bi bi-arrow-down me-1"></i>
                        Scrollez pour continuer
                    </small>
                </div>

            </div>
        </div>
    </div>

    <!-- PARTIE DROITE - HÉROS FIXE (ne défile pas) -->
    <div class="fixed-hero">
        <div class="hero-content">
            <i class="bi bi-building fs-1 mb-3 d-block" style="color: #748cab;"></i>
            <h2 class="fw-bold mb-2 display-5" style="color: #f0ebd8;">HR-Smart</h2>
            <p class="mb-3" style="color: #748cab;">La solution complète pour votre RH</p>
            <div class="mt-4">
                <div class="d-flex justify-content-center gap-4">
                    <div>
                        <i class="bi bi-people fs-4" style="color: #748cab;"></i>
                        <p class="small mt-1 mb-0" style="color: #748cab;">Gestion des employés</p>
                    </div>
                    <div>
                        <i class="bi bi-calendar fs-4" style="color: #748cab;"></i>
                        <p class="small mt-1 mb-0" style="color: #748cab;">Congés & Absences</p>
                    </div>
                    <div>
                        <i class="bi bi-graph-up fs-4" style="color: #748cab;"></i>
                        <p class="small mt-1 mb-0" style="color: #748cab;">Performances</p>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="border-color: #748cab;">

            <div class="mt-3">
                <small style="color: #748cab;">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Rejoignez plus de 500 entreprises
                </small>
            </div>

            <div class="mt-4">
                <div class="d-flex justify-content-center gap-3">
                    <i class="bi bi-shield-check fs-5" style="color: #748cab;"></i>
                    <i class="bi bi-cloud fs-5" style="color: #748cab;"></i>
                    <i class="bi bi-headset fs-5" style="color: #748cab;"></i>
                </div>
            </div>
        </div>
    </div>


</x-guest-layout>
