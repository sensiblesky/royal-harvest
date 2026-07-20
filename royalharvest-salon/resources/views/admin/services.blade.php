<x-layouts.admin title="Services">
    <div class="grid lg:grid-cols-3 gap-8">
        {{-- List --}}
        <div class="lg:col-span-2 space-y-4">
            @forelse ($services as $service)
                <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="text-xl font-semibold text-charcoal-900">{{ $service->name }}</h3>
                                <span class="px-2.5 py-0.5 rounded-full text-xs {{ $service->isActive ? 'bg-green-100 text-green-700' : 'bg-charcoal-100 text-charcoal-500' }}">
                                    {{ $service->isActive ? 'Active' : 'Hidden' }}
                                </span>
                            </div>
                            <p class="text-sm text-charcoal-400 mt-1">{{ $service->tagline }}</p>
                            <p class="text-sm mt-2 text-gold-600">{{ $service->price }} · {{ $service->duration }}</p>
                            @if ($service->requiresDeposit())
                                <p class="text-xs mt-1 text-charcoal-400">Exact: TSh {{ number_format($service->price_amount) }} · Deposit (10%): <strong>TSh {{ number_format($service->depositAmount()) }}</strong></p>
                            @else
                                <p class="text-xs mt-1 text-charcoal-400">No exact price → no deposit (enquiry only)</p>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.services.toggle', $service) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="text-xs px-3 py-1.5 rounded-lg bg-charcoal-900 text-white hover:bg-charcoal-800">{{ $service->isActive ? 'Hide' : 'Show' }}</button>
                            </form>
                            <form action="{{ route('admin.services.remove', $service) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                                @csrf @method('DELETE')
                                <button class="text-xs px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">Delete</button>
                            </form>
                        </div>
                    </div>

                    <details class="mt-4">
                        <summary class="text-xs uppercase tracking-widest text-charcoal-400 cursor-pointer hover:text-gold-500">Edit</summary>
                        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="mt-4 grid sm:grid-cols-2 gap-4">
                            @csrf @method('PATCH')
                            <input name="name" value="{{ $service->name }}" class="field" placeholder="Name" required>
                            <input name="tagline" value="{{ $service->tagline }}" class="field" placeholder="Tagline">
                            <input name="price" value="{{ $service->price }}" class="field" placeholder="Price label (e.g. From TSh 350,000)">
                            <input name="price_amount" type="number" min="0" value="{{ $service->price_amount }}" class="field" placeholder="Exact price TZS (for 10% deposit)">
                            <input name="duration" value="{{ $service->duration }}" class="field" placeholder="Duration">
                            <input name="icon" value="{{ $service->icon }}" class="field" placeholder="Icon (crown, scissors…)">
                            <input name="sort" type="number" value="{{ $service->sort }}" class="field" placeholder="Sort">
                            <textarea name="description" class="field sm:col-span-2" rows="2" placeholder="Description">{{ $service->description }}</textarea>
                            <button class="btn-gold sm:col-span-2 text-xs">Save changes</button>
                        </form>
                    </details>
                </div>
            @empty
                <p class="text-charcoal-400">No services yet.</p>
            @endforelse
        </div>

        {{-- Add --}}
        <div>
            <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-charcoal-900 mb-4">Add a service</h3>
                <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input name="name" class="field" placeholder="Name *" required>
                    <input name="tagline" class="field" placeholder="Tagline">
                    <input name="price" class="field" placeholder="Price label (e.g. From TSh 350,000)">
                    <input name="price_amount" type="number" min="0" class="field" placeholder="Exact price TZS (blank = no deposit)">
                    <input name="duration" class="field" placeholder="Duration">
                    <input name="icon" class="field" placeholder="Icon (crown, scissors…)">
                    <textarea name="description" class="field" rows="3" placeholder="Description"></textarea>
                    <button class="btn-gold w-full text-xs">Add service</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
