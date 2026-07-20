<x-layouts.app title="Programmes">
    <x-ui.page-hero title="Our Programmes" image="images/afr-curly.jpg" crumb="Schools">
        Professional courses designed to launch your beauty career.
    </x-ui.page-hero>

    <section class="py-24">
        <div class="container-x">
            @if ($programmes->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($programmes as $programme)
                        <article class="reveal group bg-white rounded-2xl overflow-hidden shadow-sm border border-charcoal-100/60 card-lift">
                            <div class="h-52 bg-cover bg-center"
                                style="background-image:url('{{ asset($programme->image ?? 'images/afr-curly.jpg') }}')"></div>
                            <div class="p-7">
                                <h3 class="text-2xl font-semibold text-charcoal-900">{{ $programme->name }}</h3>
                                <p class="mt-2 text-sm text-charcoal-400 leading-relaxed">{{ $programme->summary }}</p>
                                <div class="mt-5 flex items-center justify-between border-t border-charcoal-100 pt-4">
                                    <div>
                                        <p class="text-xs uppercase tracking-widest text-charcoal-400">Duration</p>
                                        <p class="text-sm font-medium text-charcoal-900">{{ $programme->duration }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs uppercase tracking-widest text-charcoal-400">Fee</p>
                                        <p class="text-sm font-medium text-gold-600">{{ $programme->cost }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('apply') }}" class="btn-gold w-full mt-6 text-xs">Apply for this programme</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="text-center text-charcoal-400">No programmes available right now — check back soon.</p>
            @endif
        </div>
    </section>
</x-layouts.app>
