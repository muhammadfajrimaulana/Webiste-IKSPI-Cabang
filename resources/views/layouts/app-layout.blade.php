<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Keanggotaan IKSPI Kera Sakti Cabang Jakpus' }}</title>

    <link rel="icon" href="{{ asset('assets/img/logo-ikspi.png') }}" type="image/png" sizes="16x16">
    <link rel="icon" href="{{ asset('assets/img/logo-ikspi.png') }}" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}" sizes="180x180">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <main>
        {{ $slot }}
    </main>

</body>

</html>
