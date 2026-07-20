<x-layouts.app title="About">
    <x-ui.page-hero title="About Royal Harvest" image="images/salon-interior.jpg" crumb="Our story" />

    {{-- Intro --}}
    <section class="py-24">
        <div class="container-x grid lg:grid-cols-2 gap-14 items-center">
            <img src="{{ asset('images/afr-curly.jpg') }}" alt="Royal Harvest Group"
                class="reveal rounded-2xl shadow-2xl w-full h-[560px] object-cover">
            <div>
                <x-ui.section-heading eyebrow="The Group" title="A Tanzanian beauty group" align="left" />
                <div class="mt-6 space-y-4 text-charcoal-400 leading-relaxed">
                    <p>Royal Harvest is a home-grown Tanzanian group headquartered in Arusha, building trusted
                        brands across beauty, education, products and wellness. We started with a passion for
                        beauty and a belief that world-class service can be built right here at home.</p>
                    <p>Today the group is a family of ventures — our flagship Pixies Bridal Saloon, our professional
                        beauty academy, and new products and wellness ventures on the way — each sharing the same
                        commitment to quality, craftsmanship and community.</p>
                    <p>We invest in local talent, celebrate African beauty, and grow businesses that Tanzanians can
                        be proud of.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Ventures --}}
    <section class="py-20 bg-cream-dark">
        <div class="container-x">
            <x-ui.section-heading eyebrow="Our Ventures" title="What we're building" />
            <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($ventures as $venture)
                    <x-ui.venture-card :venture="$venture" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="py-24">
        <div class="container-x">
            <x-ui.section-heading eyebrow="Why Royal Harvest" title="What we stand for" />
            <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ([
                    ['sparkles', 'Quality first', 'Every venture is held to the same high standard of service and craftsmanship.'],
                    ['users', 'Local talent', 'We train, hire and grow Tanzanian talent — investing in people, not just businesses.'],
                    ['crown', 'African beauty', 'We celebrate and serve African beauty with pride, expertise and authenticity.'],
                ] as [$icon, $title, $text])
                    <div class="reveal bg-white rounded-2xl p-8 shadow-sm border border-charcoal-100/60">
                        <span class="w-12 h-12 grid place-items-center rounded-full bg-gold-50 text-gold-500">
                            <x-ui.icon :name="$icon" class="w-6 h-6" />
                        </span>
                        <h3 class="mt-5 text-xl font-semibold text-charcoal-900">{{ $title }}</h3>
                        <p class="mt-2 text-sm text-charcoal-400 leading-relaxed">{{ $text }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
