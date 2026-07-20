<x-layouts.admin title="Enquiries">
    <p class="text-sm text-charcoal-400 mb-6">Callback requests from customers who preferred not to pay a deposit online.</p>

    <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-charcoal-50 text-charcoal-400 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="text-left px-6 py-3">Name</th>
                        <th class="text-left px-6 py-3">Phone</th>
                        <th class="text-left px-6 py-3">Service</th>
                        <th class="text-left px-6 py-3">Message</th>
                        <th class="text-left px-6 py-3">Status</th>
                        <th class="text-right px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal-100">
                    @forelse ($enquiries as $e)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $e->fullname }}</td>
                            <td class="px-6 py-4">{{ $e->phone }}</td>
                            <td class="px-6 py-4">{{ $e->service ?? '—' }}</td>
                            <td class="px-6 py-4 text-charcoal-500 max-w-xs">{{ $e->message ?: '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs {{ $e->handled ? 'bg-green-100 text-green-700' : 'bg-gold-100 text-gold-700' }}">
                                    {{ $e->handled ? 'Handled' : 'New' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('admin.enquiries.toggle', $e) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="text-xs px-3 py-1.5 rounded-lg bg-charcoal-900 text-white hover:bg-charcoal-800">{{ $e->handled ? 'Reopen' : 'Mark handled' }}</button>
                                    </form>
                                    <form action="{{ route('admin.enquiries.remove', $e) }}" method="POST" onsubmit="return confirm('Delete this enquiry?')">
                                        @csrf @method('DELETE')
                                        <button class="text-xs px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-charcoal-400">No enquiries yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">{{ $enquiries->links() }}</div>
</x-layouts.admin>
