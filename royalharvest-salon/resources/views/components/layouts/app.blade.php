@props(['title' => null, 'description' => null, 'solidNav' => false])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth no-js">

<head>
    <script>document.documentElement.classList.remove('no-js');</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <x-seo :title="$title" :description="$description" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Jost:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body>
    <x-ui.navbar :solid="$solidNav" />

    <main>
        {{ $slot }}
    </main>

    <x-ui.footer />

    <x-ui.floating-actions />
    <x-ui.cookie-notice />
</body>

</html>
