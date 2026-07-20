<div data-cookie-notice
    class="hidden fixed z-50 bottom-4 left-4 right-4 sm:left-6 sm:right-auto sm:max-w-md
           bg-charcoal-900 text-white/85 rounded-2xl shadow-2xl shadow-black/30 p-5">
    <p class="text-sm leading-relaxed">
        We use cookies to give you the best experience on our site. By continuing, you agree to our use of cookies.
    </p>
    <div class="mt-4 flex gap-3">
        <button data-cookie-accept class="btn-gold !py-2 !px-5 text-xs">Accept</button>
        <a href="{{ route('home') }}" class="text-xs uppercase tracking-widest text-white/50 self-center hover:text-gold-300">Learn more</a>
    </div>
</div>

<script>
    (function () {
        var KEY = 'pixies_cookie_ok';
        var el = document.querySelector('[data-cookie-notice]');
        if (!el) return;
        try { if (localStorage.getItem(KEY)) return; } catch (e) { return; }
        el.classList.remove('hidden');
        el.querySelector('[data-cookie-accept]').addEventListener('click', function () {
            try { localStorage.setItem(KEY, '1'); } catch (e) {}
            el.remove();
        });
    })();
</script>
