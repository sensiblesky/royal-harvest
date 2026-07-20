<footer class="bg-charcoal-950 text-white/70">
    <div class="container-x py-16 lg:py-20">
        <div class="grid gap-12 lg:grid-cols-4">
            {{-- Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="font-display text-3xl font-semibold text-white">
                    Pixies <span class="text-gold-400">Bridal</span>
                </a>
                <p class="mt-4 text-sm leading-relaxed">
                    Where beauty meets artistry — timeless bridal looks and premium beauty services for your most
                    cherished moments.
                </p>
                <div class="mt-6 flex gap-3">
                    @foreach (['instagram' => 'IG', 'facebook' => 'FB', 'tiktok' => 'TT', 'whatsapp' => 'WA'] as $key => $abbr)
                        <a href="{{ config('site.socials.' . $key) }}" target="_blank" rel="noopener"
                            class="w-9 h-9 grid place-items-center rounded-full border border-white/15 text-xs hover:border-gold-400 hover:text-gold-400 transition">
                            {{ $abbr }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Explore --}}
            <div>
                <h4 class="text-white text-lg mb-5">Explore</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-gold-400 transition">Home</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-gold-400 transition">Services</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-gold-400 transition">Gallery</a></li>
                    <li><a href="{{ route('booking') }}" class="hover:text-gold-400 transition">Book Now</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-gold-400 transition">Contact</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-white text-lg mb-5">Get in touch</h4>
                <ul class="space-y-3 text-sm">
                    <li>{{ config('site.address') }}</li>
                    <li><a href="tel:{{ preg_replace('/\s+/', '', config('site.phone')) }}"
                            class="hover:text-gold-400 transition">{{ config('site.phone') }}</a></li>
                    <li><a href="mailto:{{ config('site.email') }}"
                            class="hover:text-gold-400 transition">{{ config('site.email') }}</a></li>
                </ul>
                <a href="{{ config('site.company_url') }}" target="_blank" rel="noopener"
                    class="mt-5 inline-flex items-center gap-2 text-xs uppercase tracking-widest text-gold-300 hover:text-gold-400 transition">
                    Part of Royal Harvest →
                </a>
            </div>

            {{-- Newsletter --}}
            <div>
                <h4 class="text-white text-lg mb-5">Newsletter</h4>
                <p class="text-sm mb-4">Beauty tips & offers, straight to your inbox.</p>
                <form action="{{ route('subscribe') }}" method="POST" class="flex flex-col gap-3">
                    @csrf
                    <input type="email" name="email" required placeholder="Your email"
                        class="field !bg-white/5 !border-white/15 !text-white placeholder-white/40">
                    <button class="btn-gold text-xs">Subscribe</button>
                </form>
                @if (session('subscribed'))
                    <p class="mt-3 text-xs text-gold-300">{{ session('subscribed') }}</p>
                @endif
            </div>
        </div>

        <div class="mt-14 pt-8 border-t border-white/10 flex flex-col sm:flex-row justify-between gap-4 text-xs">
            <p>&copy; {{ date('Y') }} Pixies Bridal Saloon. All rights reserved.</p>
            <p>Crafted with care in Tanzania.</p>
        </div>
    </div>
</footer>
