<x-layouts.admin title="Bookings">
    <div class="flex flex-wrap gap-2 mb-6">
        @foreach (['all' => 'All', 'pending' => 'Pending', 'done' => 'Completed'] as $key => $label)
            <a href="{{ route('admin.bookings', ['status' => $key]) }}"
                class="px-5 py-2 rounded-full text-sm transition {{ $filter === $key ? 'bg-gold-400 text-charcoal-900 font-medium' : 'bg-white border border-charcoal-100 text-charcoal-500 hover:border-gold-300' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-charcoal-50 text-charcoal-400 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="text-left px-6 py-3">Code</th>
                        <th class="text-left px-6 py-3">Client</th>
                        <th class="text-left px-6 py-3">Contact</th>
                        <th class="text-left px-6 py-3">Service</th>
                        <th class="text-left px-6 py-3">Date / Time</th>
                        <th class="text-left px-6 py-3">Deposit</th>
                        <th class="text-left px-6 py-3">Status</th>
                        <th class="text-right px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal-100">
                    @forelse ($bookings as $b)
                        <tr>
                            <td class="px-6 py-4 font-medium">#{{ $b->code }}</td>
                            <td class="px-6 py-4">{{ $b->fullname }}</td>
                            <td class="px-6 py-4 text-charcoal-500">
                                {{ $b->phone }}@if ($b->email)<br><span class="text-xs">{{ $b->email }}</span>@endif
                            </td>
                            <td class="px-6 py-4">{{ $b->service }}</td>
                            <td class="px-6 py-4">{{ $b->date }}<br><span class="text-xs text-charcoal-400">{{ $b->time }}</span></td>
                            <td class="px-6 py-4">
                                @php
                                    $pay = [
                                        'paid' => ['bg-green-100 text-green-700', 'Paid'],
                                        'pending' => ['bg-blue-100 text-blue-700', 'Pending'],
                                        'unpaid' => ['bg-red-50 text-red-600', 'Unpaid'],
                                        'failed' => ['bg-red-100 text-red-700', 'Failed'],
                                        'not_required' => ['bg-charcoal-100 text-charcoal-500', 'N/A'],
                                    ][$b->payment_status] ?? ['bg-charcoal-100 text-charcoal-500', $b->payment_status];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs {{ $pay[0] }}">{{ $pay[1] }}</span>
                                @if ($b->deposit_amount)
                                    <div class="text-xs text-charcoal-400 mt-1">TSh {{ number_format($b->deposit_amount) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs {{ $b->isDone ? 'bg-green-100 text-green-700' : 'bg-gold-100 text-gold-700' }}">
                                    {{ $b->isDone ? 'Done' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('admin.bookings.toggle', $b) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="text-xs px-3 py-1.5 rounded-lg bg-charcoal-900 text-white hover:bg-charcoal-800">
                                            {{ $b->isDone ? 'Reopen' : 'Mark done' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.bookings.remove', $b) }}" method="POST" onsubmit="return confirm('Delete this booking?')">
                                        @csrf @method('DELETE')
                                        <button class="text-xs px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-6 py-10 text-center text-charcoal-400">No bookings found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $bookings->links() }}</div>
</x-layouts.admin>
