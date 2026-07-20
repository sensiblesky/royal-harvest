<x-layouts.app>
    {{-- ============ HERO ============ --}}
    <section class="relative min-h-screen flex items-center">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ asset('images/bg_3.jpg') }}')">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal-950/92 via-charcoal-950/72 to-charcoal-950/30">
        </div>

        <div class="container-x relative pt-28">
            <div class="max-w-2xl text-white">
                <span class="eyebrow !text-gold-300 reveal">Royal Harvest Group · Arusha, Tanzania</span>
                <h1 class="reveal font-display text-5xl md:text-7xl font-semibold leading-[1.05]">
                    A family of <span class="text-gold-400">beauty</span> ventures
                </h1>
                <p class="reveal mt-6 text-lg text-white/80 max-w-lg">
                    Royal Harvest is a Tanzanian group building trusted brands in beauty, education and
                    wellness — from our flagship bridal salon to our training academy, with more on the way.
                </p>
                <div class="reveal mt-9 flex flex-wrap gap-4">
                    <a href="#ventures" class="btn-gold">Explore our ventures</a>
                    <a href="{{ route('about') }}" class="btn-outline !text-white !border-white/40 hover:!bg-white hover:!text-charcoal-900">About the group</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ STATS ============ --}}
    <section class="bg-charcoal-900 text-white py-14">
        <div class="container-x grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            @foreach (['4' => 'Ventures & growing', '500+' => 'Clients & graduates', '10+' => 'Experts on the team', 'Arusha' => 'Proudly Tanzanian'] as $num => $label)
                <div class="reveal">
                    <p class="font-display text-4xl lg:text-5xl font-semibold text-gold-400">{{ $num }}</p>
                    <p class="mt-1 text-xs uppercase tracking-widest text-white/60">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============ VENTURES ============ --}}
    <section id="ventures" class="py-24 scroll-mt-24">
        <div class="container-x">
            <x-ui.section-heading eyebrow="Our Ventures" title="One group, many brands">
                Each Royal Harvest venture is built on the same promise — quality, craftsmanship and pride in
                serving our community.
            </x-ui.section-heading>

            <div class="mt-16 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($ventures as $venture)
                    <x-ui.venture-card :venture="$venture" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ ABOUT STRIP ============ --}}
    <section class="py-24 bg-cream-dark">
        <div class="container-x grid lg:grid-cols-2 gap-14 items-center">
            <div class="reveal">
                <img src="{{ asset('images/afr-woman.jpg') }}" alt="Royal Harvest Group"
                    class="rounded-2xl shadow-2xl w-full h-[480px] object-cover">
            </div>
            <div>
                <x-ui.section-heading eyebrow="Who We Are" title="Building beauty brands in Tanzania" align="left">
                    Royal Harvest is a home-grown group with a simple mission: create beauty businesses that
                    Tanzanians are proud of.
                </x-ui.section-heading>
                <p class="mt-6 text-charcoal-400 leading-relaxed">
                    From our flagship Pixies Bridal Saloon to our professional beauty academy — and new ventures
                    in products and wellness on the way — we invest in talent, quality and our community across
                    Arusha and beyond.
                </p>
                <a href="{{ route('about') }}" class="btn-dark mt-9">Learn more about us</a>
            </div>
        </div>
    </section>

    {{-- ============ CTA ============ --}}
    <section class="relative py-28">
        <div class="absolute inset-0 bg-cover bg-fixed bg-center" style="background-image:url('{{ asset('images/bg_5.jpg') }}')"></div>
        <div class="absolute inset-0 bg-charcoal-950/85"></div>
        <div class="container-x relative text-center text-white max-w-2xl">
            <span class="eyebrow !text-gold-300 reveal">Grow with us</span>
            <h2 class="reveal font-display text-4xl md:text-5xl font-semibold">Partner, train or work with Royal Harvest</h2>
            <p class="reveal mt-4 text-white/75">Whether you want to learn a craft, join our team or partner with us — we would love to hear from you.</p>
            <div class="reveal mt-8 flex flex-wrap gap-4 justify-center">
                <a href="{{ route('programmes') }}" class="btn-gold">Join the academy</a>
                <a href="{{ route('contact') }}" class="btn-outline !text-white !border-white/40 hover:!bg-white hover:!text-charcoal-900">Get in touch</a>
            </div>
        </div>
    </section>

    {{-- ============ BLOG ============ --}}
    @if ($posts->count())
        <section class="py-24">
            <div class="container-x">
                <x-ui.section-heading eyebrow="From the Group" title="News & insights" />
                <div class="mt-16 grid md:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <a href="{{ route('blogs.show', $post) }}" class="reveal group block bg-white rounded-2xl overflow-hidden card-lift">
                            <div class="h-48 bg-cover bg-center" style="background-image:url('{{ asset($post->image ?? 'images/afr-woman.jpg') }}')"></div>
                            <div class="p-6">
                                <p class="text-xs uppercase tracking-widest text-charcoal-400">{{ $post->created_at->format('j M Y') }}</p>
                                <h3 class="mt-2 text-xl font-semibold text-charcoal-900 group-hover:text-gold-600 transition">{{ $post->title }}</h3>
                                <p class="mt-2 text-sm text-charcoal-400 line-clamp-2">{{ $post->content }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
