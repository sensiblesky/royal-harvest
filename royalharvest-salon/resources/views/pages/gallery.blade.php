<x-layouts.app title="Gallery">
    <x-ui.page-hero title="Our Gallery" image="images/afr-woman.jpg" crumb="Portfolio">
        A glimpse of the looks we create — from radiant bridal makeup to elegant hairstyling and pampering care.
    </x-ui.page-hero>

    <section class="py-24">
        <div class="container-x">
            <x-ui.section-heading eyebrow="Our Work" title="Beauty, crafted with care">
                Every look tells a story. Browse a selection of our signature bridal, makeup, hair and spa work.
            </x-ui.section-heading>

            <div class="mt-16 columns-1 sm:columns-2 lg:columns-3 gap-6 [column-fill:balance]">
                @foreach ($images as $img)
                    <button type="button" data-lightbox-src="{{ asset($img['src']) }}"
                        class="reveal mb-6 block w-full overflow-hidden rounded-2xl group relative">
                        <img src="{{ asset($img['src']) }}" alt="{{ $img['title'] }} — {{ $img['category'] }}"
                            class="w-full object-cover transition duration-700 group-hover:scale-105">
                        {{-- Caption overlay --}}
                        <div class="absolute inset-0 flex flex-col justify-end p-5 text-left
                            bg-gradient-to-t from-charcoal-950/80 via-charcoal-950/10 to-transparent
                            opacity-0 group-hover:opacity-100 transition duration-500">
                            <span class="text-gold-300 text-[0.65rem] uppercase tracking-[0.25em]">{{ $img['category'] }}</span>
                            <span class="text-white text-lg font-display font-semibold">{{ $img['title'] }}</span>
                        </div>
                    </button>
                @endforeach
            </div>

            <div class="mt-14 text-center">
                <p class="text-charcoal-400">Love what you see? Let us create your perfect look.</p>
                <a href="{{ route('booking') }}" class="btn-gold mt-5">Book an Appointment</a>
            </div>
        </div>
    </section>

    {{-- Lightbox --}}
    <div data-lightbox class="hidden fixed inset-0 z-[60] bg-charcoal-950/90 items-center justify-center p-6 cursor-zoom-out">
        <img src="" alt="Preview" class="max-h-[88vh] max-w-full rounded-lg shadow-2xl">
    </div>
</x-layouts.app>
