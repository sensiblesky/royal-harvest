<x-layouts.app title="About">
    <x-ui.page-hero title="More About Us" image="images/salon-interior.jpg" crumb="Our story" />

    <section class="py-24">
        <div class="container-x grid lg:grid-cols-2 gap-14 items-center">
            <img src="{{ asset('images/about.jpg') }}" alt="Pixies Bridal Saloon"
                class="reveal rounded-2xl shadow-2xl w-full h-[560px] object-cover">
            <div>
                <x-ui.section-heading eyebrow="Pixies Bridal Saloon" title="Timeless bridal looks for cherished moments" align="left" />
                <div class="mt-6 space-y-4 text-charcoal-400 leading-relaxed">
                    <p>Pixies Bridal Saloon is a premium beauty destination dedicated to making every bride look and
                        feel extraordinary on her special day. We specialize in elegant bridal makeup, hairstyling,
                        and personalized beauty services that bring out your natural glow with style and perfection.</p>
                    <p>Crafted with passion, precision and a touch of glamour — from flawless makeup to stunning
                        hairstyles, we turn your dream bridal look into a beautiful reality.</p>
                    <p>Pixies Bridal Saloon is where beauty meets artistry. Our expert team delivers customized makeup
                        and hairstyling that reflects your unique style and enhances your natural elegance.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-charcoal-900 text-white">
        <div class="container-x grid sm:grid-cols-2 lg:grid-cols-4 gap-10 text-center">
            @foreach (['10+' => 'Years of experience', '2K+' => 'Happy clients', '500+' => 'Bridal looks', '15+' => 'Beauty experts'] as $num => $label)
                <div class="reveal">
                    <p class="font-display text-5xl font-semibold text-gold-400">{{ $num }}</p>
                    <p class="mt-2 text-sm uppercase tracking-widest text-white/60">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="py-24">
        <div class="container-x">
            <x-ui.section-heading eyebrow="Part of something bigger" title="A Royal Harvest venture" />
            <p class="reveal mt-6 max-w-2xl mx-auto text-center text-charcoal-400">
                Pixies Bridal Saloon proudly operates under the Royal Harvest family, which also runs a professional
                beauty &amp; styling training academy. Explore the school and our other ventures.
            </p>
            <div class="mt-8 text-center">
                <a href="{{ config('site.company_url') }}" target="_blank" rel="noopener" class="btn-outline">Visit Royal Harvest →</a>
            </div>
        </div>
    </section>
</x-layouts.app>
