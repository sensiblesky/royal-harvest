<x-layouts.admin title="Ventures">
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-4">
            @forelse ($ventures as $venture)
                <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 flex-wrap">
                                <h3 class="text-xl font-semibold text-charcoal-900">{{ $venture->name }}</h3>
                                <span class="px-2.5 py-0.5 rounded-full text-xs {{ $venture->status === 'live' ? 'bg-green-100 text-green-700' : 'bg-gold-100 text-gold-700' }}">
                                    {{ $venture->status === 'live' ? 'Live' : 'Coming soon' }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs {{ $venture->isActive ? 'bg-charcoal-100 text-charcoal-600' : 'bg-red-50 text-red-500' }}">
                                    {{ $venture->isActive ? 'Shown' : 'Hidden' }}
                                </span>
                                @if ($venture->category)
                                    <span class="text-xs text-charcoal-400">{{ $venture->category }}</span>
                                @endif
                            </div>
                            <p class="text-sm text-charcoal-400 mt-1">{{ $venture->tagline }}</p>
                            <p class="text-sm text-charcoal-400 mt-1">{{ $venture->description }}</p>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <form action="{{ route('admin.ventures.toggle', $venture) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="text-xs px-3 py-1.5 rounded-lg bg-charcoal-900 text-white hover:bg-charcoal-800">{{ $venture->isActive ? 'Hide' : 'Show' }}</button>
                            </form>
                            <form action="{{ route('admin.ventures.remove', $venture) }}" method="POST" onsubmit="return confirm('Delete this venture?')">
                                @csrf @method('DELETE')
                                <button class="text-xs px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">Delete</button>
                            </form>
                        </div>
                    </div>
                    <details class="mt-4">
                        <summary class="text-xs uppercase tracking-widest text-charcoal-400 cursor-pointer hover:text-gold-500">Edit</summary>
                        <form action="{{ route('admin.ventures.update', $venture) }}" method="POST" enctype="multipart/form-data" class="mt-4 grid sm:grid-cols-2 gap-4">
                            @csrf @method('PATCH')
                            <input name="name" value="{{ $venture->name }}" class="field" placeholder="Name" required>
                            <input name="tagline" value="{{ $venture->tagline }}" class="field" placeholder="Tagline">
                            <input name="category" value="{{ $venture->category }}" class="field" placeholder="Category">
                            <input name="icon" value="{{ $venture->icon }}" class="field" placeholder="Icon (crown, sparkles, leaf, heart, users)">
                            <input name="url" value="{{ $venture->url }}" class="field" placeholder="Link (URL or /path)">
                            <select name="status" class="field">
                                <option value="live" @selected($venture->status === 'live')>Live</option>
                                <option value="coming_soon" @selected($venture->status === 'coming_soon')>Coming soon</option>
                            </select>
                            <input name="sort" type="number" value="{{ $venture->sort }}" class="field" placeholder="Sort order">
                            <input type="file" name="image" accept="image/*"
                                class="block w-full text-sm text-charcoal-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gold-100 file:text-gold-700 file:text-xs">
                            <textarea name="description" class="field sm:col-span-2" rows="2" placeholder="Description">{{ $venture->description }}</textarea>
                            <button class="btn-gold sm:col-span-2 text-xs">Save changes</button>
                        </form>
                    </details>
                </div>
            @empty
                <p class="text-charcoal-400">No ventures yet.</p>
            @endforelse
        </div>

        <div>
            <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-charcoal-900 mb-4">Add a venture</h3>
                <form action="{{ route('admin.ventures.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input name="name" class="field" placeholder="Name *" required>
                    <input name="tagline" class="field" placeholder="Tagline">
                    <input name="category" class="field" placeholder="Category (Beauty, Retail…)">
                    <input name="icon" class="field" placeholder="Icon (crown, sparkles…)">
                    <input name="url" class="field" placeholder="Link (URL or /path)">
                    <select name="status" class="field">
                        <option value="live">Live</option>
                        <option value="coming_soon" selected>Coming soon</option>
                    </select>
                    <textarea name="description" class="field" rows="3" placeholder="Description"></textarea>
                    <input type="file" name="image" accept="image/*"
                        class="block w-full text-sm text-charcoal-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gold-100 file:text-gold-700 file:text-xs">
                    <button class="btn-gold w-full text-xs">Add venture</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
