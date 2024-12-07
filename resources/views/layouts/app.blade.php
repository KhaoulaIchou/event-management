<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Événements')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

</head>

<body class="bg-gray-100">
    <nav class="bg-blue-500 text-white p-4">
        <div class="container mx-auto">
            <a href="{{ route('events.index') }}" class="text-lg font-semibold">Gestion des Événements</a>
        </div>
    </nav>
    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>

</html>
