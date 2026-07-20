<x-layouts.admin title="Programmes">
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-4">
            @forelse ($programmes as $programme)
                <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="text-xl font-semibold text-charcoal-900">{{ $programme->name }}</h3>
                                <span class="px-2.5 py-0.5 rounded-full text-xs {{ $programme->isActive ? 'bg-green-100 text-green-700' : 'bg-charcoal-100 text-charcoal-500' }}">
                                    {{ $programme->isActive ? 'Active' : 'Hidden' }}
                                </span>
                            </div>
                            <p class="text-sm mt-1 text-gold-600">{{ $programme->cost }} · {{ $programme->duration }}</p>
                            <p class="text-sm text-charcoal-400 mt-1">{{ $programme->summary }}</p>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <form action="{{ route('admin.programmes.toggle', $programme) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="text-xs px-3 py-1.5 rounded-lg bg-charcoal-900 text-white hover:bg-charcoal-800">{{ $programme->isActive ? 'Hide' : 'Show' }}</button>
                            </form>
                            <form action="{{ route('admin.programmes.remove', $programme) }}" method="POST" onsubmit="return confirm('Delete this programme?')">
                                @csrf @method('DELETE')
                                <button class="text-xs px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">Delete</button>
                            </form>
                        </div>
                    </div>
                    <details class="mt-4">
                        <summary class="text-xs uppercase tracking-widest text-charcoal-400 cursor-pointer hover:text-gold-500">Edit</summary>
                        <form action="{{ route('admin.programmes.update', $programme) }}" method="POST" class="mt-4 grid sm:grid-cols-2 gap-4">
                            @csrf @method('PATCH')
                            <input name="name" value="{{ $programme->name }}" class="field" placeholder="Name" required>
                            <input name="cost" value="{{ $programme->cost }}" class="field" placeholder="Cost" required>
                            <input name="duration" value="{{ $programme->duration }}" class="field" placeholder="Duration" required>
                            <textarea name="summary" class="field sm:col-span-2" rows="2" placeholder="Summary">{{ $programme->summary }}</textarea>
                            <button class="btn-gold sm:col-span-2 text-xs">Save changes</button>
                        </form>
                    </details>
                </div>
            @empty
                <p class="text-charcoal-400">No programmes yet.</p>
            @endforelse
        </div>

        <div>
            <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-charcoal-900 mb-4">Add a programme</h3>
                <form action="{{ route('admin.programmes.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input name="name" class="field" placeholder="Name *" required>
                    <input name="cost" class="field" placeholder="Cost * (e.g. TSh 250,000)" required>
                    <input name="duration" class="field" placeholder="Duration * (e.g. 3 Months)" required>
                    <textarea name="summary" class="field" rows="3" placeholder="Summary"></textarea>
                    <button class="btn-gold w-full text-xs">Add programme</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
