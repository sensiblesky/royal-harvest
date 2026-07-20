<x-layouts.admin title="Messages">
    <div class="space-y-4">
        @forelse ($contacts as $c)
            <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="font-semibold text-charcoal-900">{{ $c->subject }}</h3>
                        <p class="text-sm text-charcoal-400 mt-0.5">
                            {{ $c->name }} · <a href="mailto:{{ $c->email }}" class="text-gold-600 hover:underline">{{ $c->email }}</a>
                            · {{ $c->created_at->diffForHumans() }}
                        </p>
                        <p class="mt-3 text-charcoal-700 leading-relaxed">{{ $c->body }}</p>
                    </div>
                    <form action="{{ route('admin.contacts.remove', $c) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                        @csrf @method('DELETE')
                        <button class="text-xs px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 shrink-0">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-charcoal-400">No messages yet.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $contacts->links() }}</div>
</x-layouts.admin>
