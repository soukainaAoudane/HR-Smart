<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refus de congé - HR-Smart</title>
    <style>
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }
            .responsive-padding {
                padding: 20px !important;
            }
            .button {
                width: 100% !important;
                display: block !important;
            }
            .button-td {
                display: block !important;
                width: 100% !important;
            }
            .button-link {
                display: block !important;
                width: 100% !important;
                text-align: center !important;
            }
        }
        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
        }
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #f0f2f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif;">

    <center style="width: 100%; background-color: #f0f2f5;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5" style="background-color: #f0f2f5;">
            <tr>
                <td align="center" style="padding: 40px 20px;">

                    <!-- Conteneur principal -->
                    <table class="container" width="520" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="max-width: 520px; width: 100%; background-color: #ffffff; border-radius: 8px;">

                        <!-- Header rouge/orange pour refus -->
                        <tr>
                            <td bgcolor="#dc3545" style="background-color: #dc3545; border-radius: 8px 8px 0 0; padding: 40px 30px; text-align: center;">
                                <h1 style="font-size: 20px; font-weight: 600; color: #ffffff; margin: 0 0 8px 0;">
                                    Congé refusé
                                </h1>
                                <p style="font-size: 14px; color: #ffc8c8; margin: 0;">HR-Smart</p>
                            </td>
                        </tr>

                        <!-- Body -->
                        <tr>
                            <td class="responsive-padding" style="padding: 35px 30px 30px 30px;">

                                <!-- Bonjour -->
                                <p style="font-size: 15px; color: #111827; margin: 0 0 24px 0; line-height: 1.5;">
                                    Bonjour <strong>{{ $conge->user->name }}</strong>,
                                </p>

                                <!-- Message de refus -->
                                <p style="font-size: 14px; color: #374151; margin: 0 0 20px 0; line-height: 1.5;">
                                    Nous regrettons de vous informer que votre demande de congé a été <strong style="color: #dc3545;">refusée</strong>.
                                </p>

                                <!-- Détails du congé -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff5f5" style="background-color: #fff5f5; border-radius: 6px; margin: 20px 0;">
                                    <tr>
                                        <td style="padding: 16px;">
                                            <p style="margin: 0 0 8px 0; font-size: 14px; font-weight: 600; color: #dc3545;">
                                                Détails de la demande
                                            </p>
                                            <p style="margin: 0; font-size: 13px; color: #c82333;">
                                                <strong>Période :</strong> {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }} → {{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}<br>
                                                <strong>Durée :</strong> {{ $conge->duree }} jours<br>
                                                <strong>Type :</strong>
                                                @if($conge->type == 'paye') Congé payé
                                                @elseif($conge->type == 'rtt') RTT
                                                @elseif($conge->type == 'sans_solde') Congé sans solde
                                                @else Congé formation
                                                @endif
                                            </p>
                                            @if($conge->commentaire_manager)
                                            <p style="margin: 12px 0 0 0; font-size: 13px; color: #c82333;">
                                                <strong>Motif du refus :</strong><br>
                                                {{ $conge->commentaire_manager }}
                                            </p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                <!-- Bouton -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin: 28px 0 28px 0;">
                                    <tr>
                                        <td align="center">
                                            <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                <tr>
                                                    <td class="button-td" align="center" bgcolor="#1e3a5f" style="background-color: #1e3a5f; border-radius: 6px; padding: 0;">
                                                        <a href="{{ url('/employe/conges') }}" class="button-link" target="_blank" style="display: inline-block; padding: 12px 28px; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 500; border-radius: 6px;">
                                                            Voir mes congés
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Info solde -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f8fafc" style="background-color: #f8fafc; border-radius: 6px; margin: 16px 0;">
                                    <tr>
                                        <td style="padding: 12px 16px;">
                                            <p style="margin: 0; font-size: 12px; color: #475569;">
                                                Solde de congés restant : <strong>{{ $conge->user->conges_restants }}</strong> jours
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Footer message -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f8fafc" style="background-color: #f8fafc; border-radius: 6px; margin: 12px 0;">
                                    <tr>
                                        <td style="padding: 12px 16px;">
                                            <p style="margin: 0; font-size: 12px; color: #475569;">
                                                Pour toute question, n'hésitez pas à contacter votre manager.
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                            \n
                        </tr>

                        <!-- Footer gris clair -->
                        <tr>
                            <td bgcolor="#f8fafc" style="background-color: #f8fafc; border-radius: 0 0 8px 8px; padding: 24px 30px; text-align: center;">
                                <p style="margin: 0 0 6px 0; font-size: 12px; color: #475569;">
                                    HR-Smart - Plateforme de Gestion RH
                                </p>
                                <p style="margin: 0; font-size: 11px; color: #94a3b8;">
                                    © {{ date('Y') }} Tous droits réservés
                                </p>
                            </td>
                        </tr>

                    </table>

                \n
            </tr>
        </table>
    </center>

</body>
</html>
