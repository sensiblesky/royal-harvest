<footer class="bg-charcoal-950 text-white/70">
    <div class="container-x py-16 lg:py-20">
        <div class="grid gap-12 lg:grid-cols-4">
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="font-display text-3xl font-semibold text-white">
                    Royal <span class="text-gold-400">Harvest</span>
                </a>
                <p class="mt-4 text-sm leading-relaxed">
                    A Tanzanian beauty group in Arusha — building trusted brands across beauty, education,
                    products and wellness.
                </p>
                <div class="mt-6 flex gap-3">
                    @foreach (['instagram' => 'IG', 'facebook' => 'FB', 'linkedin' => 'IN', 'whatsapp' => 'WA'] as $key => $abbr)
                        <a href="{{ config('site.socials.' . $key) }}" target="_blank" rel="noopener"
                            class="w-9 h-9 grid place-items-center rounded-full border border-white/15 text-xs hover:border-gold-400 hover:text-gold-400 transition">
                            {{ $abbr }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="text-white text-lg mb-5">Explore</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-gold-400 transition">About Us</a></li>
                    <li><a href="{{ route('programmes') }}" class="hover:text-gold-400 transition">Programmes</a></li>
                    <li><a href="{{ route('apply') }}" class="hover:text-gold-400 transition">How to Apply</a></li>
                    <li><a href="{{ route('blogs') }}" class="hover:text-gold-400 transition">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-gold-400 transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white text-lg mb-5">Get in touch</h4>
                <ul class="space-y-3 text-sm">
                    <li>{{ config('site.address') }}</li>
                    <li><a href="tel:{{ preg_replace('/\s+/', '', config('site.phone')) }}"
                            class="hover:text-gold-400 transition">{{ config('site.phone') }}</a></li>
                    <li><a href="mailto:{{ config('site.email') }}"
                            class="hover:text-gold-400 transition">{{ config('site.email') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white text-lg mb-5">Our Salon</h4>
                <p class="text-sm mb-4">Visit Pixies Bridal Saloon — our premium beauty destination.</p>
                <a href="{{ config('site.salon_url') }}" target="_blank" rel="noopener" class="btn-outline text-xs">
                    Visit Pixies Bridal →
                </a>
            </div>
        </div>

        <div class="mt-14 pt-8 border-t border-white/10 flex flex-col sm:flex-row justify-between gap-4 text-xs">
            <p>&copy; {{ date('Y') }} Royal Harvest. All rights reserved.</p>
            <p>Crafted with care in Tanzania.</p>
        </div>
    </div>
</footer>
