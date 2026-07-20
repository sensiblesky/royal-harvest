<x-layouts.app :title="$blog->title">
    <x-ui.page-hero :title="$blog->title" :image="$blog->image ?? 'images/afr-woman.jpg'" crumb="Blog" />

    <article class="py-24">
        <div class="container-x max-w-3xl">
            <p class="text-xs uppercase tracking-widest text-charcoal-400">{{ $blog->created_at->format('l, j F Y') }}</p>
            @if ($blog->image)
                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                    class="mt-6 rounded-2xl w-full h-[420px] object-cover shadow-lg">
            @endif
            <div class="mt-8 prose max-w-none text-charcoal-700 leading-relaxed whitespace-pre-line text-lg">
                {{ $blog->content }}
            </div>

            <a href="{{ route('blogs') }}" class="btn-outline mt-12">← Back to blog</a>
        </div>
    </article>

    @if ($related->count())
        <section class="py-16 bg-cream-dark">
            <div class="container-x">
                <x-ui.section-heading title="More posts" />
                <div class="mt-12 grid md:grid-cols-3 gap-8">
                    @foreach ($related as $post)
                        <a href="{{ route('blogs.show', $post) }}" class="group block bg-white rounded-2xl overflow-hidden card-lift">
                            <div class="h-40 bg-cover bg-center" style="background-image:url('{{ asset($post->image ?? 'images/afr-woman.jpg') }}')"></div>
                            <div class="p-5">
                                <h3 class="font-semibold text-charcoal-900 group-hover:text-gold-600 transition">{{ $post->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
