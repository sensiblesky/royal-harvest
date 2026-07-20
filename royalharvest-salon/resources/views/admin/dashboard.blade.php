<x-layouts.admin title="Dashboard">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ([
            ['Total bookings', $stats['bookings'], 'gold'],
            ['Deposits paid', $stats['paid'], 'charcoal'],
            ['Pending visits', $stats['pending'], 'gold'],
            ['New enquiries', $stats['enquiries'], 'charcoal'],
        ] as [$label, $value, $tone])
            <div class="bg-white rounded-2xl p-6 border border-charcoal-100 shadow-sm">
                <p class="text-xs uppercase tracking-widest text-charcoal-400">{{ $label }}</p>
                <p class="mt-3 font-display text-5xl font-semibold {{ $tone === 'gold' ? 'text-gold-500' : 'text-charcoal-900' }}">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 bg-white rounded-2xl border border-charcoal-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-charcoal-100 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-charcoal-900">Recent bookings</h2>
            <a href="{{ route('admin.bookings') }}" class="text-sm text-gold-600 hover:text-gold-500">View all →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-charcoal-50 text-charcoal-400 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="text-left px-6 py-3">Code</th>
                        <th class="text-left px-6 py-3">Client</th>
                        <th class="text-left px-6 py-3">Service</th>
                        <th class="text-left px-6 py-3">Date</th>
                        <th class="text-left px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal-100">
                    @forelse ($recent as $b)
                        <tr>
                            <td class="px-6 py-4 font-medium">#{{ $b->code }}</td>
                            <td class="px-6 py-4">{{ $b->fullname }}</td>
                            <td class="px-6 py-4">{{ $b->service }}</td>
                            <td class="px-6 py-4">{{ $b->date }} {{ $b->time }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs {{ $b->isDone ? 'bg-green-100 text-green-700' : 'bg-gold-100 text-gold-700' }}">
                                    {{ $b->isDone ? 'Done' : 'Pending' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-charcoal-400">No bookings yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
