<x-layouts.admin title="Dashboard">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ([
            ['Ventures', $stats['ventures'], 'gold'],
            ['Programmes', $stats['programmes'], 'charcoal'],
            ['Applications', $stats['candidates'], 'gold'],
            ['Messages', $stats['contacts'], 'charcoal'],
        ] as [$label, $value, $tone])
            <div class="bg-white rounded-2xl p-6 border border-charcoal-100 shadow-sm">
                <p class="text-xs uppercase tracking-widest text-charcoal-400">{{ $label }}</p>
                <p class="mt-3 font-display text-5xl font-semibold {{ $tone === 'gold' ? 'text-gold-500' : 'text-charcoal-900' }}">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 bg-white rounded-2xl border border-charcoal-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-charcoal-100 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-charcoal-900">Recent applications</h2>
            <a href="{{ route('admin.candidates') }}" class="text-sm text-gold-600 hover:text-gold-500">View all →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-charcoal-50 text-charcoal-400 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="text-left px-6 py-3">Name</th>
                        <th class="text-left px-6 py-3">Programme</th>
                        <th class="text-left px-6 py-3">Contact</th>
                        <th class="text-left px-6 py-3">Applied</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal-100">
                    @forelse ($recent as $c)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $c->first }} {{ $c->last }}</td>
                            <td class="px-6 py-4">{{ $c->programme->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-charcoal-500">{{ $c->phone }}</td>
                            <td class="px-6 py-4 text-charcoal-400">{{ $c->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-10 text-center text-charcoal-400">No applications yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
