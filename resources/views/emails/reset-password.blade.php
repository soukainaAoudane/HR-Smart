<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation mot de passe - HR-Smart</title>
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

<body
    style="margin: 0; padding: 0; background-color: #f0f2f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif;">

    <center style="width: 100%; background-color: #f0f2f5;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5"
            style="background-color: #f0f2f5;">
            <tr>
                <td align="center" style="padding: 40px 20px;">

                    <!-- Conteneur principal -->
                    <table class="container" width="520" border="0" cellpadding="0" cellspacing="0"
                        bgcolor="#ffffff"
                        style="max-width: 520px; width: 100%; background-color: #ffffff; border-radius: 8px;">

                        <!-- Header bleu -->
                        <tr>
                            <td bgcolor="#1a56db"
                                style="background-color: #1a56db; border-radius: 8px 8px 0 0; padding: 40px 30px; text-align: center;">
                                <h1 style="font-size: 20px; font-weight: 600; color: #ffffff; margin: 0 0 8px 0;">
                                    Réinitialisation du mot de passe</h1>
                                <p style="font-size: 14px; color: #bfdbfe; margin: 0;">HR-Smart</p>
                            </td>
                        </tr>

                        <!-- Body -->
                        <tr>
                            <td class="responsive-padding" style="padding: 35px 30px 30px 30px;">

                                <!-- Bonjour -->
                                <p style="font-size: 15px; color: #111827; margin: 0 0 24px 0; line-height: 1.5;">
                                    Bonjour <strong>{{ $user->name }}</strong>,
                                </p>

                                <!-- Message -->
                                <p style="font-size: 14px; color: #374151; margin: 0 0 20px 0; line-height: 1.5;">
                                    Nous avons reçu une demande de réinitialisation de votre mot de passe. Cliquez sur
                                    le bouton ci-dessous pour en créer un nouveau.
                                </p>

                                <!-- Bouton bleu -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                    style="margin: 28px 0 28px 0;">
                                    <tr>
                                        <td align="center">
                                            <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                <tr>
                                                    <td class="button-td" align="center" bgcolor="#1a56db"
                                                        style="background-color: #1a56db; border-radius: 6px; padding: 0;">
                                                        <a href="{{ $url }}" class="button-link"
                                                            target="_blank"
                                                            style="display: inline-block; padding: 12px 28px; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 500; border-radius: 6px;">
                                                            Réinitialiser mon mot de passe
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Délai -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#eff6ff"
                                    style="background-color: #eff6ff; border-radius: 6px; margin: 16px 0;">
                                    <tr>
                                        <td style="padding: 12px 16px;">
                                            <p style="margin: 0; font-size: 12px; color: #1e40af;">
                                                Lien valable pendant 60 minutes
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Ignorer -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f8fafc"
                                    style="background-color: #f8fafc; border-radius: 6px; margin: 12px 0;">
                                    <tr>
                                        <td style="padding: 12px 16px;">
                                            <p style="margin: 0; font-size: 12px; color: #475569;">
                                                Vous n'avez pas fait cette demande ? Ignorez simplement cet email.
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Lien alternatif -->
                                <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                    style="margin-top: 28px;">
                                    <tr>
                                        <td style="padding-top: 20px; border-top: 1px solid #e2e8f0;">
                                            <p style="margin: 0 0 8px 0; font-size: 11px; color: #64748b;">
                                                Si le bouton ne fonctionne pas, copiez ce lien dans votre navigateur :
                                            </p>
                                            <a href="{{ $url }}" target="_blank"
                                                style="font-size: 11px; color: #1a56db; word-break: break-all; text-decoration: underline;">
                                                {{ $url }}
                                            </a>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>

                        <!-- Footer gris clair -->
                        <tr>
                            <td bgcolor="#f8fafc"
                                style="background-color: #f8fafc; border-radius: 0 0 8px 8px; padding: 24px 30px; text-align: center;">
                                <p style="margin: 0 0 6px 0; font-size: 12px; color: #475569;">
                                    HR-Smart - Plateforme de Gestion RH
                                </p>
                                <p style="margin: 0; font-size: 11px; color: #94a3b8;">
                                    © {{ date('Y') }} Tous droits réservés
                                </p>
                            </td>
                        </tr>

                    </table>

                </td>
            </tr>
        </table>
    </center>

</body>

</html>
