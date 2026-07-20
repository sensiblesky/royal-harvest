<x-layouts.app title="Blog">
    <x-ui.page-hero title="News & Insights" image="images/makeup-flatlay.jpg" crumb="Blog">
        Stories, tips and updates from Royal Harvest.
    </x-ui.page-hero>

    <section class="py-24">
        <div class="container-x">
            @if ($posts->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <a href="{{ route('blogs.show', $post) }}" class="reveal group block bg-white rounded-2xl overflow-hidden shadow-sm border border-charcoal-100/60 card-lift">
                            <div class="h-52 bg-cover bg-center" style="background-image:url('{{ asset($post->image ?? 'images/afr-woman.jpg') }}')"></div>
                            <div class="p-6">
                                <p class="text-xs uppercase tracking-widest text-charcoal-400">{{ $post->created_at->format('j M Y') }}</p>
                                <h3 class="mt-2 text-xl font-semibold text-charcoal-900 group-hover:text-gold-600 transition">{{ $post->title }}</h3>
                                <p class="mt-2 text-sm text-charcoal-400 line-clamp-3">{{ $post->content }}</p>
                                <span class="mt-4 inline-flex text-xs uppercase tracking-widest text-gold-600">Read more →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-12">{{ $posts->links() }}</div>
            @else
                <p class="text-center text-charcoal-400">No posts yet — check back soon.</p>
            @endif
        </div>
    </section>
</x-layouts.app>
