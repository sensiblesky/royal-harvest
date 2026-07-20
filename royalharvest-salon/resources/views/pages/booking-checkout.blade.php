<x-layouts.app title="Secure Your Booking" :solidNav="true">
    <section class="pt-32 pb-24">
        <div class="container-x max-w-2xl">
            <div class="text-center mb-8">
                <span class="eyebrow">Almost there</span>
                <h1 class="font-display text-4xl font-semibold text-charcoal-900">Secure your appointment</h1>
                <p class="mt-3 text-charcoal-400">
                    To confirm your booking, please pay a small
                    <strong>{{ \App\Models\Service::DEPOSIT_PERCENT }}% deposit</strong>. The balance is paid at the salon.
                </p>
            </div>

            {{-- Summary --}}
            <div class="bg-white rounded-2xl shadow-xl border border-charcoal-100/60 p-8">
                <div class="bg-cream rounded-xl p-6 divide-y divide-charcoal-100 mb-8">
                    @foreach ([
                        'Service' => $booking->service,
                        'Date' => \Carbon\Carbon::parse($booking->date)->format('l, j M Y') . ' · ' . $booking->time,
                        'Full price' => 'TSh ' . number_format($booking->service_amount),
                    ] as $label => $value)
                        <div class="flex justify-between py-3">
                            <span class="text-charcoal-400 text-sm">{{ $label }}</span>
                            <span class="text-charcoal-900 font-medium text-sm">{{ $value }}</span>
                        </div>
                    @endforeach
                    <div class="flex justify-between py-4 items-center">
                        <span class="text-charcoal-900 font-semibold">Deposit due now</span>
                        <span class="text-gold-600 font-display text-2xl font-semibold">TSh {{ number_format($booking->deposit_amount) }}</span>
                    </div>
                </div>

                <div class="space-y-4 mb-6"><x-ui.flash /></div>

                @if (! $paymentsConfigured)
                    <div class="rounded-xl bg-gold-50 border border-gold-200 text-gold-800 px-5 py-4 text-sm mb-6">
                        Online payment is temporarily unavailable. Please use the enquiry option below and we'll reach out to confirm your booking.
                    </div>
                @else
                    <form action="{{ route('booking.pay', $booking) }}" method="POST">
                        @csrf
                        {{-- Method toggle --}}
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <label class="cursor-pointer">
                                <input type="radio" name="method" value="mobile" class="peer sr-only" checked
                                    onclick="document.getElementById('mobileFields').classList.remove('hidden')">
                                <div class="rounded-xl border-2 border-charcoal-100 peer-checked:border-gold-400 peer-checked:bg-gold-50 p-5 text-center transition">
                                    <p class="font-medium text-charcoal-900">Mobile Money</p>
                                    <p class="text-xs text-charcoal-400 mt-1">M-Pesa, Airtel, Mixx, Halotel</p>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="method" value="card" class="peer sr-only"
                                    onclick="document.getElementById('mobileFields').classList.add('hidden')">
                                <div class="rounded-xl border-2 border-charcoal-100 peer-checked:border-gold-400 peer-checked:bg-gold-50 p-5 text-center transition">
                                    <p class="font-medium text-charcoal-900">Card</p>
                                    <p class="text-xs text-charcoal-400 mt-1">Visa / Mastercard</p>
                                </div>
                            </label>
                        </div>

                        <div id="mobileFields">
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Mobile money number</label>
                            <input name="phone_number" value="{{ old('phone_number', $booking->phone) }}"
                                class="field" placeholder="07XXXXXXXX">
                            <p class="text-xs text-charcoal-400 mt-2">You'll get a prompt on this number to enter your PIN.</p>
                        </div>

                        <button class="btn-gold w-full mt-6">Pay TSh {{ number_format($booking->deposit_amount) }} Deposit</button>
                    </form>
                @endif
            </div>

            {{-- No-deposit fallback --}}
            <div class="mt-8 bg-white/60 rounded-2xl border border-dashed border-charcoal-100 p-6 text-center">
                <p class="text-sm text-charcoal-500">Prefer not to pay a deposit online?</p>
                <details class="mt-3 group">
                    <summary class="cursor-pointer text-gold-600 text-sm font-medium hover:text-gold-500">Request a callback instead →</summary>
                    <form action="{{ route('enquiry.store') }}" method="POST" class="mt-5 text-left space-y-4">
                        @csrf
                        <input type="hidden" name="service" value="{{ $booking->service }}">
                        @if (session('enquiry_sent'))
                            <p class="rounded-xl bg-gold-50 border border-gold-200 text-gold-800 px-4 py-3 text-sm">{{ session('enquiry_sent') }}</p>
                        @endif
                        <div class="grid sm:grid-cols-2 gap-4">
                            <input name="fullname" value="{{ $booking->fullname }}" required class="field" placeholder="Your name">
                            <input name="phone" value="{{ $booking->phone }}" required class="field" placeholder="Phone">
                        </div>
                        <textarea name="message" rows="2" class="field" placeholder="Anything we should know? (optional)"></textarea>
                        <button class="btn-outline w-full">Request a callback</button>
                    </form>
                </details>
            </div>
        </div>
    </section>
</x-layouts.app>
