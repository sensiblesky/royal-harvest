<x-layouts.app title="Book an Appointment">
    <x-ui.page-hero title="Book an Appointment" image="images/afr-woman.jpg" crumb="Reservations">
        Reserve your spot — we'll confirm shortly.
    </x-ui.page-hero>

    <section class="py-24">
        <div class="container-x max-w-3xl">
            <div class="bg-white rounded-2xl shadow-xl border border-charcoal-100/60 p-8 lg:p-12">
                <div class="text-center mb-8">
                    <span class="eyebrow">Appointment</span>
                    <h2 class="font-display text-3xl font-semibold text-charcoal-900">Tell us your details</h2>
                    <p class="mt-3 text-sm text-charcoal-400">
                        A <strong>{{ \App\Models\Service::DEPOSIT_PERCENT }}% deposit</strong> secures your slot —
                        the balance is paid at the salon. Prefer not to pay online? You can request a callback instead.
                    </p>
                </div>

                <div class="space-y-4 mb-6"><x-ui.flash /></div>

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Full name *</label>
                            <input name="fullname" value="{{ old('fullname') }}" required class="field" placeholder="Jane Doe">
                        </div>
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Phone *</label>
                            <input name="phone" value="{{ old('phone') }}" required class="field" placeholder="07XXXXXXXX">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Email (optional)</label>
                        <input name="email" type="email" value="{{ old('email') }}" class="field" placeholder="you@email.com">
                    </div>

                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Service *</label>
                        <select name="service" required class="field">
                            @php($selectedService = old('service', request('service')))
                            <option value="" disabled @selected(! $selectedService)>Choose a service…</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->name }}" @selected($selectedService === $service->name)>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Preferred date *</label>
                            <input name="date" type="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required class="field">
                        </div>
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Preferred time *</label>
                            <input name="time" type="time" value="{{ old('time') }}" required class="field">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Notes (optional)</label>
                        <textarea name="notes" rows="3" class="field" placeholder="Anything we should know?">{{ old('notes') }}</textarea>
                    </div>

                    <button class="btn-gold w-full">Confirm Booking</button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.app>
