@php
    $whatsapp = config('site.socials.whatsapp');
@endphp

<div class="fixed z-40 bottom-5 right-5 flex flex-col items-end gap-3">
    {{-- WhatsApp --}}
    @if ($whatsapp)
        <a href="{{ $whatsapp }}?text={{ urlencode('Hello Royal Harvest, I would like to know more about your programmes.') }}"
            target="_blank" rel="noopener" aria-label="Chat on WhatsApp"
            class="group flex items-center gap-2 rounded-full bg-[#25D366] text-white shadow-lg shadow-black/20 pl-3 pr-4 py-3 hover:scale-105 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.5 14.4c-.3-.1-1.7-.8-2-.9-.3-.1-.5-.1-.7.1-.2.3-.7.9-.9 1.1-.2.2-.3.2-.6.1-1.7-.9-2.9-1.6-4-3.5-.3-.5.3-.5.8-1.6.1-.2 0-.4 0-.5-.1-.1-.7-1.6-.9-2.2-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.3 5.2 4.6 2 .8 2.7.9 3.7.8.6-.1 1.7-.7 2-1.4.2-.7.2-1.2.2-1.4-.1-.1-.3-.2-.6-.3zM12 2a10 10 0 00-8.6 15l-1.3 4.7 4.8-1.3A10 10 0 1012 2z"/>
            </svg>
            <span class="text-sm font-medium hidden sm:inline">Chat with us</span>
        </a>
    @endif

    {{-- Back to top --}}
    <button data-back-to-top aria-label="Back to top"
        class="hidden w-11 h-11 rounded-full bg-charcoal-900 text-gold-400 shadow-lg shadow-black/20 items-center justify-center hover:bg-charcoal-800 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>
</div>
