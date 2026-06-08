<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - HR-Smart</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
            height: 100vh;
        }

        /* Partie gauche - FORMULAIRE SCROLLABLE (défile) */
        .scrollable-form {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            background: #f0ebd8;
        }

        /* Partie droite - HÉROS FIXE (ne défile pas) */
        .fixed-hero {
            position: fixed;
            top: 0;
            right: 0;
            width: 50%;
            height: 100vh;
            overflow: hidden;
            background: #1d2d44;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Custom scrollbar pour formulaire */
        .scrollable-form::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-form::-webkit-scrollbar-track {
            background: #f0ebd8;
        }

        .scrollable-form::-webkit-scrollbar-thumb {
            background: #748cab;
            border-radius: 3px;
        }

        .scrollable-form::-webkit-scrollbar-thumb:hover {
            background: #3e5c76;
        }

        /* Contenu formulaire */
        .form-content {
            padding: 60px 40px;
            min-height: 100%;
        }

        .form-container {
            max-width: 450px;
            margin: 0 auto;
        }

        .btn-custom {
            background-color: #3e5c76;
            border: none;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-custom:hover {
            background-color: #748cab;
            transform: translateY(-2px);
        }

        /* Animation pour la partie fixe */
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 20px;
        }

        /* Effet de brillance arrière-plan */
        .fixed-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.03) 1%, transparent 1%);
            background-size: 30px 30px;
            animation: shimmer 30s linear infinite;
        }

        @keyframes shimmer {
            from {
                transform: translateX(0) translateY(0);
            }

            to {
                transform: translateX(50px) translateY(50px);
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .fixed-hero {
                display: none;
            }

            .scrollable-form {
                width: 100%;
            }
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

{{ $slot }}

</html>
