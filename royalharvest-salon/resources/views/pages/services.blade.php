<x-layouts.app title="Services">
    <x-ui.page-hero title="Our Services" image="images/bg_8.jpg" crumb="What we offer">
        A full suite of premium beauty experiences, tailored to you.
    </x-ui.page-hero>

    <section class="py-24">
        <div class="container-x space-y-20">
            @foreach ($services as $i => $service)
                <div class="reveal grid lg:grid-cols-2 gap-12 items-center {{ $i % 2 ? 'lg:[direction:rtl]' : '' }}">
                    <div class="[direction:ltr]">
                        <img src="{{ asset($service->image ?? 'images/image_1.jpg') }}" alt="{{ $service->name }}"
                            class="rounded-2xl shadow-xl w-full h-[420px] object-cover">
                    </div>
                    <div class="[direction:ltr]">
                        <div class="flex items-center gap-3 text-gold-500">
                            <x-ui.icon :name="$service->icon ?? 'sparkles'" class="w-8 h-8" />
                            <span class="eyebrow !mb-0">{{ $service->tagline }}</span>
                        </div>
                        <h2 class="mt-4 font-display text-4xl font-semibold text-charcoal-900">{{ $service->name }}</h2>
                        <p class="mt-4 text-charcoal-400 leading-relaxed">{{ $service->description }}</p>
                        <div class="mt-6 flex flex-wrap gap-8">
                            <div>
                                <p class="text-xs uppercase tracking-widest text-charcoal-400">Price</p>
                                <p class="text-lg font-medium text-gold-600">{{ $service->price ?? 'On request' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-charcoal-400">Duration</p>
                                <p class="text-lg font-medium text-charcoal-900">{{ $service->duration ?? '—' }}</p>
                            </div>
                        </div>
                        <a href="{{ route('booking', ['service' => $service->name]) }}" class="btn-gold mt-8">Book this service</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.app>
