@php
    $code = $code ?? '';
    $heading = $heading ?? 'Something went wrong';
    $message = $message ?? 'Please try again in a moment.';
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $code }} — Pixies Bridal Saloon</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen grid place-items-center bg-charcoal-950 text-white px-6">
    <div class="text-center max-w-lg">
        <p class="font-display text-[7rem] leading-none font-semibold text-gold-400">{{ $code }}</p>
        <h1 class="font-display text-3xl md:text-4xl font-semibold mt-2">{{ $heading }}</h1>
        <p class="mt-4 text-white/70">{{ $message }}</p>
        <a href="{{ url('/') }}" class="btn-gold mt-8">Back to Home</a>
    </div>
</body>
</html>
