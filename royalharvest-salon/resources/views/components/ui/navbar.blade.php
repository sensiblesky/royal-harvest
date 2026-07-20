@props(['solid' => false])

@php
    $links = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Services', 'route' => 'services'],
        ['label' => 'Gallery', 'route' => 'gallery'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

{{-- `solid` keeps a dark background from the top, for pages that don't have a dark hero
     (so the white nav text stays readable). --}}
<header data-navbar @class(['fixed inset-x-0 top-0 z-50', 'is-solid' => $solid])>
    <div class="container-x">
        <div class="flex items-center justify-between py-4 lg:py-5">
            {{-- Brand --}}
            <a href="{{ route('home') }}" class="group flex flex-col leading-none">
                <span class="font-display text-2xl lg:text-3xl font-semibold text-white">
                    Pixies <span class="text-gold-400">Bridal</span>
                </span>
                <span class="text-[0.6rem] uppercase tracking-[0.4em] text-gold-200/80">Saloon</span>
            </a>

            {{-- Desktop nav --}}
            <nav class="hidden lg:flex items-center gap-9">
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}"
                        class="text-sm uppercase tracking-widest font-medium transition-colors {{ request()->routeIs($link['route']) ? 'text-gold-400' : 'text-white/85 hover:text-gold-300' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden lg:flex items-center gap-4">
                <a href="tel:{{ preg_replace('/\s+/', '', config('site.phone')) }}"
                    class="text-sm text-white/80 hover:text-gold-300 transition">{{ config('site.phone') }}</a>
                <a href="{{ route('booking') }}" class="btn-gold !py-2.5 !px-6 text-xs">Book Now</a>
            </div>

            {{-- Mobile toggle --}}
            <button data-nav-toggle class="lg:hidden text-white p-2 rounded-lg bg-charcoal-900/40 backdrop-blur-sm" aria-label="Toggle menu">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div data-nav-menu class="hidden lg:hidden bg-charcoal-900/98 backdrop-blur border-t border-white/10">
        <nav class="container-x py-6 flex flex-col gap-4">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}"
                    class="text-sm uppercase tracking-widest {{ request()->routeIs($link['route']) ? 'text-gold-400' : 'text-white/85' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <a href="{{ route('booking') }}" class="btn-gold mt-2 self-start text-xs">Book Now</a>
        </nav>
    </div>
</header>
