<x-layouts.admin title="Blog">
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-4">
            @forelse ($blogs as $blog)
                <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6 flex gap-5">
                    @if ($blog->image)
                        <img src="{{ asset(str_starts_with($blog->image, 'images/') ? $blog->image : 'storage/' . $blog->image) }}"
                            class="w-28 h-24 rounded-xl object-cover shrink-0" alt="">
                    @endif
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-charcoal-900">{{ $blog->title }}</h3>
                        <p class="text-xs text-charcoal-400 mt-0.5">{{ $blog->created_at->format('j M Y') }}</p>
                        <p class="text-sm text-charcoal-500 mt-2 line-clamp-2">{{ $blog->content }}</p>
                    </div>
                    <form action="{{ route('admin.blogs.remove', $blog) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button class="text-xs px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 shrink-0">Delete</button>
                    </form>
                </div>
            @empty
                <p class="text-charcoal-400">No posts yet.</p>
            @endforelse
        </div>

        <div>
            <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-charcoal-900 mb-4">New post</h3>
                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input name="title" class="field" placeholder="Title *" required>
                    <textarea name="content" class="field" rows="6" placeholder="Content *" required></textarea>
                    <input type="file" name="image" accept="image/*"
                        class="block w-full text-sm text-charcoal-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gold-100 file:text-gold-700 file:text-xs">
                    <button class="btn-gold w-full text-xs">Publish post</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
