<x-layouts.admin title="Subscribers">
    <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-charcoal-50 text-charcoal-400 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="text-left px-6 py-3">Email</th>
                        <th class="text-left px-6 py-3">Subscribed</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal-100">
                    @forelse ($subscribers as $s)
                        <tr>
                            <td class="px-6 py-4">{{ $s->email }}</td>
                            <td class="px-6 py-4 text-charcoal-400">{{ $s->created_at->format('j M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="px-6 py-10 text-center text-charcoal-400">No subscribers yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">{{ $subscribers->links() }}</div>
</x-layouts.admin>
