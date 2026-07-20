<x-layouts.app>
    {{-- ============ HERO ============ --}}
    <section class="relative min-h-screen flex items-center">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ asset('images/bg_8.jpg') }}')">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal-950/90 via-charcoal-950/70 to-charcoal-950/30">
        </div>

        <div class="container-x relative pt-28">
            <div class="max-w-2xl text-white">
                <span class="eyebrow !text-gold-300 reveal">Pixies Bridal Saloon</span>
                <h1 class="reveal font-display text-5xl md:text-7xl font-semibold leading-[1.05]">
                    Experience <span class="text-gold-400">Royal</span> Beauty
                </h1>
                <p class="reveal mt-6 text-lg text-white/80 max-w-lg">
                    Where elegance meets perfection. Premium bridal makeup, hairstyling and beauty
                    services crafted with passion — for both men &amp; women.
                </p>
                <div class="reveal mt-9 flex flex-wrap gap-4">
                    <a href="{{ route('booking') }}" class="btn-gold">Book an Appointment</a>
                    <a href="{{ route('services') }}" class="btn-outline !text-white !border-white/40 hover:!bg-white hover:!text-charcoal-900">Our Services</a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 inset-x-0 hidden md:flex justify-center text-white/60 text-xs tracking-[0.3em] uppercase">
            Scroll to explore
        </div>
    </section>

    {{-- ============ INTRO / ABOUT ============ --}}
    <section class="py-24">
        <div class="container-x grid lg:grid-cols-2 gap-14 items-center">
            <div class="reveal relative">
                <img src="{{ asset('images/afr-woman.jpg') }}" alt="Pixies Bridal Saloon"
                    class="rounded-2xl shadow-2xl w-full h-[520px] object-cover">
                <div class="absolute -bottom-6 -right-6 bg-gold-400 text-charcoal-900 rounded-2xl px-8 py-6 shadow-xl hidden sm:block">
                    <p class="font-display text-4xl font-semibold leading-none">10+</p>
                    <p class="text-xs uppercase tracking-widest mt-1">Years of artistry</p>
                </div>
            </div>
            <div>
                <x-ui.section-heading eyebrow="About Us" title="Beauty meets artistry" align="left">
                    Pixies Bridal Saloon is a premium beauty destination dedicated to making every bride look
                    and feel extraordinary on her special day.
                </x-ui.section-heading>
                <p class="mt-6 text-charcoal-400 leading-relaxed">
                    From flawless makeup to stunning hairstyles, we turn your dream bridal look into a beautiful
                    reality — with customized styling that reflects your unique elegance.
                </p>
                <div class="mt-8 grid grid-cols-2 gap-6">
                    @foreach (['Expert stylists & artists', 'Premium, long-wear products', 'Personalized consultations', 'Relaxing, elegant space'] as $point)
                        <div class="flex items-start gap-3">
                            <span class="mt-1 text-gold-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="text-sm text-charcoal-700">{{ $point }}</span>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('about') }}" class="btn-dark mt-9">Read our story</a>
            </div>
        </div>
    </section>

    {{-- ============ SERVICES ============ --}}
    <section class="py-24 bg-cream-dark">
        <div class="container-x">
            <x-ui.section-heading eyebrow="What We Offer" title="Signature services">
                A full suite of beauty experiences, each delivered with precision and a touch of glamour.
            </x-ui.section-heading>

            <div class="mt-16 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <article class="reveal group bg-white rounded-2xl overflow-hidden card-lift">
                        <div class="h-56 bg-cover bg-center"
                            style="background-image:url('{{ asset($service->image ?? 'images/image_1.jpg') }}')"></div>
                        <div class="p-7">
                            <div class="flex items-center gap-3 text-gold-500">
                                <x-ui.icon :name="$service->icon ?? 'sparkles'" class="w-6 h-6" />
                                <span class="text-xs uppercase tracking-widest text-charcoal-400">{{ $service->duration }}</span>
                            </div>
                            <h3 class="mt-4 text-2xl font-semibold text-charcoal-900">{{ $service->name }}</h3>
                            <p class="mt-2 text-sm text-charcoal-400 leading-relaxed">{{ $service->description }}</p>
                            <div class="mt-5 flex items-center justify-between">
                                <span class="text-gold-600 font-medium">{{ $service->price }}</span>
                                <a href="{{ route('booking', ['service' => $service->name]) }}"
                                    class="text-xs uppercase tracking-widest text-charcoal-700 group-hover:text-gold-500 transition">Book →</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ CTA BANNER ============ --}}
    <section class="relative py-28">
        <div class="absolute inset-0 bg-cover bg-fixed bg-center" style="background-image:url('{{ asset('images/afr-curly.jpg') }}')"></div>
        <div class="absolute inset-0 bg-charcoal-950/80"></div>
        <div class="container-x relative text-center text-white max-w-2xl">
            <span class="eyebrow !text-gold-300 reveal">Ready when you are</span>
            <h2 class="reveal font-display text-4xl md:text-5xl font-semibold">Your special day deserves the royal treatment</h2>
            <p class="reveal mt-4 text-white/75">Reserve your appointment today and let our artists bring your vision to life.</p>
            <a href="{{ route('booking') }}" class="reveal btn-gold mt-8">Book Your Appointment</a>
        </div>
    </section>

    {{-- ============ TESTIMONIALS ============ --}}
    <section class="py-24">
        <div class="container-x">
            <x-ui.section-heading eyebrow="Kind Words" title="Loved by our brides" />
            <div class="mt-16 grid md:grid-cols-3 gap-8">
                @foreach ([['name' => 'Amina H.', 'text' => 'They made me feel like royalty on my wedding day. The makeup lasted from morning to midnight!'], ['name' => 'Grace M.', 'text' => 'Absolutely stunning hairstyling. The team is professional, warm and incredibly talented.'], ['name' => 'Neema K.', 'text' => 'Best bridal experience in Arusha. Every detail was perfect — I felt beautiful and confident.']] as $t)
                    <figure class="reveal bg-white rounded-2xl p-8 shadow-sm border border-charcoal-100/60">
                        <div class="flex gap-1 text-gold-400">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.9 3.1 1.1-6.6L.4 6.9l6.6-1L10 0l3 5.9 6.6 1-4.8 4.6 1.1 6.6z"/></svg>
                            @endfor
                        </div>
                        <blockquote class="mt-4 text-charcoal-700 leading-relaxed">"{{ $t['text'] }}"</blockquote>
                        <figcaption class="mt-6 flex items-center gap-3">
                            <span class="w-11 h-11 grid place-items-center rounded-full bg-gold-100 text-gold-700 font-semibold">{{ \Illuminate\Support\Str::of($t['name'])->explode(' ')->map(fn ($p) => \Illuminate\Support\Str::substr($p, 0, 1))->implode('') }}</span>
                            <span class="font-medium text-charcoal-900">{{ $t['name'] }}</span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
