@props(['solid' => false])

@php
    $links = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Ventures', 'route' => 'home', 'fragment' => 'ventures'],
        ['label' => 'Academy', 'route' => 'programmes'],
        ['label' => 'Blog', 'route' => 'blogs'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<header data-navbar @class(['fixed inset-x-0 top-0 z-50', 'is-solid' => $solid])>
    <div class="container-x">
        <div class="flex items-center justify-between py-4 lg:py-5">
            <a href="{{ route('home') }}" class="group flex flex-col leading-none">
                <span class="font-display text-2xl lg:text-3xl font-semibold text-white">
                    Royal <span class="text-gold-400">Harvest</span>
                </span>
                <span class="text-[0.6rem] uppercase tracking-[0.35em] text-gold-200/80">Beauty Group</span>
            </a>

            <nav class="hidden lg:flex items-center gap-9">
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) . (isset($link['fragment']) ? '#' . $link['fragment'] : '') }}"
                        class="text-sm uppercase tracking-widest font-medium transition-colors {{ request()->routeIs($link['route']) && ! isset($link['fragment']) ? 'text-gold-400' : 'text-white/85 hover:text-gold-300' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden lg:flex items-center gap-4">
                <a href="{{ config('site.salon_url') }}" target="_blank" rel="noopener"
                    class="text-xs uppercase tracking-widest text-white/70 hover:text-gold-300 transition">Our Salon ↗</a>
                <a href="{{ route('apply') }}" class="btn-gold !py-2.5 !px-6 text-xs">Apply Now</a>
            </div>

            <button data-nav-toggle class="lg:hidden text-white p-2 rounded-lg bg-charcoal-900/40 backdrop-blur-sm" aria-label="Toggle menu">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>

    <div data-nav-menu class="hidden lg:hidden bg-charcoal-900/98 backdrop-blur border-t border-white/10">
        <nav class="container-x py-6 flex flex-col gap-4">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) . (isset($link['fragment']) ? '#' . $link['fragment'] : '') }}"
                    class="text-sm uppercase tracking-widest {{ request()->routeIs($link['route']) && ! isset($link['fragment']) ? 'text-gold-400' : 'text-white/85' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <a href="{{ route('apply') }}" class="btn-gold mt-2 self-start text-xs">Apply Now</a>
        </nav>
    </div>
</header>
