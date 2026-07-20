@props(['venture'])

@php
    $comingSoon = $venture->status === 'coming_soon';
    $href = $venture->url ?: null;
    $tag = $href && ! $comingSoon ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if ($tag === 'a') href="{{ $href }}" @if (\Illuminate\Support\Str::startsWith($href, 'http')) target="_blank" rel="noopener" @endif @endif
    class="reveal group relative block bg-white rounded-2xl overflow-hidden shadow-sm border border-charcoal-100/60 {{ $comingSoon ? '' : 'card-lift' }}">

    <div class="relative h-52 bg-cover bg-center" style="background-image:url('{{ $venture->image ? (\Illuminate\Support\Str::startsWith($venture->image, 'images/') ? asset($venture->image) : asset('storage/' . $venture->image)) : asset('images/salon-interior.jpg') }}')">
        <div class="absolute inset-0 {{ $comingSoon ? 'bg-charcoal-950/70' : 'bg-charcoal-950/20 group-hover:bg-charcoal-950/10 transition' }}"></div>
        @if ($comingSoon)
            <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-[0.65rem] uppercase tracking-widest bg-gold-400 text-charcoal-900 font-semibold">Coming Soon</span>
        @endif
        @if ($venture->category)
            <span class="absolute bottom-4 left-4 px-3 py-1 rounded-full text-[0.65rem] uppercase tracking-widest bg-white/90 text-charcoal-700">{{ $venture->category }}</span>
        @endif
    </div>

    <div class="p-7">
        <div class="flex items-center gap-3 text-gold-500">
            <x-ui.icon :name="$venture->icon ?? 'sparkles'" class="w-6 h-6" />
            <h3 class="text-xl font-semibold text-charcoal-900">{{ $venture->name }}</h3>
        </div>
        <p class="mt-1 text-xs uppercase tracking-widest text-charcoal-400">{{ $venture->tagline }}</p>
        <p class="mt-3 text-sm text-charcoal-400 leading-relaxed">{{ $venture->description }}</p>

        @if (! $comingSoon && $href)
            <span class="mt-5 inline-flex text-xs uppercase tracking-widest text-gold-600 group-hover:text-gold-500 transition">
                Explore →
            </span>
        @elseif ($comingSoon)
            <span class="mt-5 inline-flex text-xs uppercase tracking-widest text-charcoal-400">Launching soon</span>
        @endif
    </div>
</{{ $tag }}>
