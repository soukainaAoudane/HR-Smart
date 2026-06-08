{{-- resources/views/employe/conge/create.blade.php --}}
<x-app-layout>
{{-- Forumulaire demandee de congé --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header border-0 text-white py-4 rounded-top-4"
                        style="background: linear-gradient(135deg, #1e3a5f 0%, #152c4a 100%);">
                        <div class="text-center">
                            <h2 class="fw-bold mb-2">
                                <i class="fas fa-umbrella-beach me-2"></i>
                                Demander un Congé
                            </h2>
                            <p class="mb-0 text-white-50">
                                Veuillez remplir les informations ci-dessous pour demander un congé
                            </p>
                        </div>
                    </div>
                    <div class="card-body p-4">

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-circle-exclamation me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Affichage du solde -->
                        <div class="alert alert-info bg-light border-0 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-coins text-warning me-2 fs-4"></i>
                                    <span class="fw-semibold">Solde de congés payés :</span>
                                </div>
                                <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ Auth::user()->conges_restants ?? 0 }} jours
                                </span>
                            </div>
                        </div>

                        <form action="{{ route('employe.conge.store') }}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="type" class="form-label fw-semibold">
                                    <i class="fas fa-tag text-info me-2"></i>
                                    Type de congé
                                </label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="paye">Congé payé</option>
                                    <option value="sans_solde">Congé sans solde</option>
                                    <option value="rrt">RTT</option>
                                    <option value="formation">Formation</option>
                                </select>
                                <small class="text-muted" id="info-type">
                                    <i class="fas fa-info-circle me-1"></i> Sélectionnez le type de congé souhaité
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_debut" class="form-label fw-semibold">
                                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                                            Date début
                                        </label>
                                        <input type="date"
                                            name="date_debut"
                                            id="date_debut"
                                            class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_fin" class="form-label fw-semibold">
                                            <i class="fas fa-calendar-check text-danger me-2"></i>
                                            Date fin
                                        </label>
                                        <input type="date"
                                            name="date_fin"
                                            id="date_fin"
                                            class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="duree" class="form-label fw-semibold">
                                            <i class="fas fa-hourglass-half text-success me-2"></i>
                                            Durée
                                        </label>
                                        <input type="number"
                                            name="duree"
                                            id="duree"
                                            class="form-control"
                                            readonly
                                            style="background-color: #e8f5e9; font-weight: bold; color: #2e7d32;">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4" id="div_heures" style="display:none;">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-clock text-warning me-2"></i>
                                    Heures supplémentaires
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white">
                                        <i class="fas fa-plus-circle"></i>
                                    </span>
                                    <input type="number"
                                        name="heures_supplementaires"
                                        class="form-control"
                                        step="0.5"
                                        value="0">
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Chaque 7h supplémentaires = 1 jour RTT
                                </small>
                            </div>

                            <div class="mb-4" id="div_justificatif" style="display:none;">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                    Justificatif de formation
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-danger text-white">
                                        <i class="fas fa-paperclip"></i>
                                    </span>
                                    <input type="file"
                                        name="justificatif"
                                        class="form-control"
                                        accept=".pdf,.doc,.docx">
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Convention de formation ou document justificatif (PDF, DOC, DOCX)
                                </small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-edit text-secondary me-2"></i>
                                    Motif
                                </label>
                                <textarea name="motif"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Décrivez brièvement le motif de votre demande..."
                                    style="resize: none;"></textarea>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Expliquez la raison de votre demande de congé
                                </small>
                            </div>

                            <div class="alert alert-warning"
                                id="warning_sans_solde"
                                style="display:none;">
                                <i class="fas fa-exclamation-triangle me-2 fs-5"></i>
                                <strong>Attention :</strong> Vous Vous avee des congés payé veuillez vous les demander
                            </div>

                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <a href="{{ route('employe.dashboard') }}"
                                    class="btn btn-outline-secondary px-4">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Retour
                                </a>
                                <button type="submit"
                                    class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Envoyer la demande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('type').addEventListener('change', function() {

            const typeValue = this.value;
            const congesRestants ={{ Auth::user()->conges_restants }};
            const warningSansSolde =
                document.getElementById('warning_sans_solde');

            const divJustificatif =
                document.getElementById('div_justificatif');

            const divHeures =
                document.getElementById('div_heures');

            divJustificatif.style.display =
                typeValue === 'formation' ? 'block' : 'none';

            divHeures.style.display =
                typeValue === 'rrt' ? 'block' : 'none';

            if(typeValue==='sans_solde' && congesRestants>0){
                warningSansSolde.style.display =
                typeValue === 'sans_solde' ? 'block' : 'none';
            }
        });

        const dureeInput = document.getElementById('duree');

        function calculerDuree() {

            const dateDebut =
                document.getElementById('date_debut').value;

            const dateFin =
                document.getElementById('date_fin').value;

            if (dateDebut && dateFin) {

                const debut = new Date(dateDebut);
                const fin = new Date(dateFin);

                const difference =
                    Math.ceil((fin - debut) / (1000 * 60 * 60 * 24)) + 1;

                dureeInput.value =
                    difference > 0 ? difference : 0;

            } else {
                dureeInput.value = '';
            }
        }

        document.getElementById('date_debut')
            .addEventListener('change', calculerDuree);

        document.getElementById('date_fin')
            .addEventListener('change', calculerDuree);

        calculerDuree();
    </script>

</x-app-layout>
