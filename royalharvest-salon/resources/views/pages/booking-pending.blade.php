<x-layouts.app title="Awaiting Payment" :solidNav="true">
    @push('head')
        <meta http-equiv="refresh" content="6">
    @endpush

    <section class="pt-32 pb-24">
        <div class="container-x max-w-xl text-center">
            <div class="bg-white rounded-2xl shadow-xl border border-charcoal-100/60 p-10">
                <div class="mx-auto w-16 h-16 grid place-items-center rounded-full bg-gold-50 text-gold-500">
                    <svg class="w-8 h-8 animate-spin" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 3v3m0 12v3m9-9h-3M6 12H3m14.5-6.5l-2 2m-9 9l-2 2m13 0l-2-2m-9-9l-2-2" />
                    </svg>
                </div>
                <h1 class="mt-6 font-display text-3xl font-semibold text-charcoal-900">Waiting for your payment…</h1>

                @if ($booking->payment_method === 'mobile')
                    <p class="mt-3 text-charcoal-400">
                        We've sent a payment request to <strong>{{ $booking->phone }}</strong>.
                        Please check your phone and enter your mobile money PIN to pay the
                        <strong>TSh {{ number_format($booking->deposit_amount) }}</strong> deposit.
                    </p>
                @else
                    <p class="mt-3 text-charcoal-400">Completing your card payment…</p>
                @endif

                <p class="mt-6 text-xs uppercase tracking-widest text-charcoal-400">This page updates automatically</p>

                <div class="mt-8 flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('booking.pending', $booking) }}" class="btn-outline text-xs">Refresh now</a>
                    <a href="{{ route('booking.checkout', $booking) }}" class="text-xs uppercase tracking-widest text-charcoal-400 self-center hover:text-gold-500">Try another method</a>
                </div>
            </div>

            {{-- Recovery link — always available even if the SMS didn't arrive --}}
            <div class="mt-6 bg-white rounded-xl border border-charcoal-100 p-5 text-center">
                <p class="text-xs text-charcoal-400">Save this link to finish paying later:</p>
                <a href="{{ route('booking.pay-link', $booking->pay_token) }}"
                    class="mt-1 inline-block text-sm text-gold-600 break-all hover:text-gold-500">{{ route('booking.pay-link', $booking->pay_token) }}</a>
            </div>

            <p class="mt-6 text-xs text-charcoal-400">Booking #{{ $booking->code }} · {{ $booking->service }}</p>
        </div>
    </section>
</x-layouts.app>
