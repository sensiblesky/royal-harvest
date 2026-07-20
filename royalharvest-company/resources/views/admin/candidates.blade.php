<x-layouts.admin title="Applications">
    <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-charcoal-50 text-charcoal-400 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="text-left px-6 py-3">Name</th>
                        <th class="text-left px-6 py-3">Programme</th>
                        <th class="text-left px-6 py-3">Contact</th>
                        <th class="text-left px-6 py-3">Status</th>
                        <th class="text-left px-6 py-3">Applied</th>
                        <th class="text-right px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal-100">
                    @forelse ($candidates as $c)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $c->first }} {{ $c->last }}</td>
                            <td class="px-6 py-4">{{ $c->programme->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-charcoal-500">
                                {{ $c->phone }}@if ($c->email)<br><span class="text-xs">{{ $c->email }}</span>@endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs {{ $c->isActive ? 'bg-green-100 text-green-700' : 'bg-charcoal-100 text-charcoal-500' }}">
                                    {{ $c->isActive ? 'Active' : 'Archived' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-charcoal-400">{{ $c->created_at->format('j M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('admin.candidates.toggle', $c) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="text-xs px-3 py-1.5 rounded-lg bg-charcoal-900 text-white hover:bg-charcoal-800">{{ $c->isActive ? 'Archive' : 'Restore' }}</button>
                                    </form>
                                    <form action="{{ route('admin.candidates.remove', $c) }}" method="POST" onsubmit="return confirm('Delete this application?')">
                                        @csrf @method('DELETE')
                                        <button class="text-xs px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-charcoal-400">No applications yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">{{ $candidates->links() }}</div>
</x-layouts.admin>
