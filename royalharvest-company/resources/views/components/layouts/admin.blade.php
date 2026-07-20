@props(['title' => 'Dashboard'])

@php
    $nav = [
        ['label' => 'Dashboard', 'route' => 'admin.index', 'match' => 'admin.index'],
        ['label' => 'Ventures', 'route' => 'admin.ventures', 'match' => 'admin.ventures'],
        ['label' => 'Programmes', 'route' => 'admin.programmes', 'match' => 'admin.programmes'],
        ['label' => 'Applications', 'route' => 'admin.candidates', 'match' => 'admin.candidates'],
        ['label' => 'Blog', 'route' => 'admin.blogs', 'match' => 'admin.blogs'],
        ['label' => 'Messages', 'route' => 'admin.contacts', 'match' => 'admin.contacts'],
        ['label' => 'My Profile', 'route' => 'admin.profile', 'match' => 'admin.profile'],
    ];
@endphp

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} — Royal Harvest Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-charcoal-50 min-h-screen lg:grid lg:grid-cols-[260px_1fr]">
    <aside class="bg-charcoal-900 text-white/80 flex flex-col lg:min-h-screen">
        <div class="p-6 border-b border-white/10">
            <a href="{{ route('admin.index') }}" class="font-display text-2xl font-semibold text-white">
                Royal <span class="text-gold-400">Admin</span>
            </a>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition {{ request()->routeIs($item['match']) ? 'bg-gold-400 text-charcoal-900 font-medium' : 'hover:bg-white/5' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="p-4 border-t border-white/10 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="block px-4 py-2 text-xs uppercase tracking-widest hover:text-gold-300">View site ↗</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full text-left px-4 py-2 text-xs uppercase tracking-widest text-red-300 hover:text-red-200">Logout</button>
            </form>
        </div>
    </aside>

    <div class="flex flex-col">
        <header class="bg-white border-b border-charcoal-100 px-6 lg:px-10 py-5 flex items-center justify-between">
            <h1 class="font-display text-3xl font-semibold text-charcoal-900">{{ $title }}</h1>
            <span class="text-sm text-charcoal-400">{{ auth()->user()->name }}</span>
        </header>

        <main class="p-6 lg:p-10 flex-1">
            <div class="space-y-4 mb-6"><x-ui.flash /></div>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
