<x-layouts.app title="Booking Confirmed" :solidNav="true">
    <section class="pt-32 pb-24">
        <div class="container-x max-w-2xl">
            <div class="bg-white rounded-2xl shadow-xl border border-charcoal-100/60 p-8 lg:p-12 text-center">
                <div class="mx-auto w-16 h-16 grid place-items-center rounded-full bg-gold-50 text-gold-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="mt-6 font-display text-4xl font-semibold text-charcoal-900">
                    {{ $booking->isPaid() ? 'Booking Confirmed!' : 'Booking Received!' }}
                </h1>
                <p class="mt-3 text-charcoal-400">
                    @if ($booking->isPaid())
                        Thank you, {{ $booking->fullname }} — your deposit is received and your appointment is secured.
                        A confirmation SMS is on its way.
                    @else
                        Thank you, {{ $booking->fullname }} — we've received your request and will contact you to confirm.
                    @endif
                </p>

                @if ($booking->isPaid() && $booking->deposit_amount)
                    <span class="mt-5 inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                        ✓ Deposit paid · TSh {{ number_format($booking->deposit_amount) }}
                    </span>
                @endif

                <div class="mt-8 text-left bg-cream rounded-xl p-6 divide-y divide-charcoal-100">
                    @php
                        $rows = [
                            'Booking code' => '#' . $booking->code,
                            'Service' => $booking->service,
                            'Date' => \Carbon\Carbon::parse($booking->date)->format('l, j M Y'),
                            'Time' => $booking->time,
                            'Phone' => $booking->phone,
                        ];
                        if ($booking->service_amount) {
                            $rows['Full price'] = 'TSh ' . number_format($booking->service_amount);
                        }
                        if ($booking->deposit_amount) {
                            $rows['Deposit ' . ($booking->isPaid() ? 'paid' : 'due')] = 'TSh ' . number_format($booking->deposit_amount);
                            $rows['Balance at salon'] = 'TSh ' . number_format(max(0, ($booking->service_amount ?? 0) - $booking->deposit_amount));
                        }
                    @endphp
                    @foreach ($rows as $label => $value)
                        <div class="flex justify-between py-3">
                            <span class="text-charcoal-400 text-sm">{{ $label }}</span>
                            <span class="text-charcoal-900 font-medium text-sm">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>

                @if ($booking->needsPayment())
                    <a href="{{ route('booking.checkout', $booking) }}"
                        class="mt-6 inline-block text-sm text-gold-600 hover:text-gold-500">Complete your deposit payment →</a>
                @endif

                <div class="mt-8 flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('booking.download', $booking) }}" class="btn-gold">Download PDF</a>
                    <a href="{{ route('home') }}" class="btn-outline">Back to Home</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
