@props(['title', 'image' => 'images/salon-interior.jpg', 'crumb' => null])

<section class="relative flex items-center justify-center min-h-[52vh] pt-24">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ asset($image) }}')"></div>
    <div class="absolute inset-0 bg-charcoal-950/70"></div>
    <div class="container-x relative text-center text-white">
        <span class="eyebrow !text-gold-300">{{ $crumb ?? 'Royal Harvest' }}</span>
        <h1 class="font-display text-4xl sm:text-5xl md:text-6xl font-semibold break-words">{{ $title }}</h1>
        @if (trim($slot))
            <p class="mt-4 max-w-xl mx-auto text-white/75">{{ $slot }}</p>
        @endif
    </div>
</section>
