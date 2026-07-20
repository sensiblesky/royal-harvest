// --- Mobile nav toggle -------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');
    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }

    // --- Sticky navbar background on scroll ---------------------------
    const nav = document.querySelector('[data-navbar]');
    if (nav) {
        const onScroll = () => {
            if (window.scrollY > 40) {
                nav.classList.add('is-scrolled');
            } else {
                nav.classList.remove('is-scrolled');
            }
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    // --- Reveal on scroll --------------------------------------------
    const reveals = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && reveals.length) {
        const io = new IntersectionObserver(
            (entries) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) {
                        e.target.classList.add('is-visible');
                        io.unobserve(e.target);
                    }
                });
            },
            { threshold: 0.12 }
        );
        reveals.forEach((el) => io.observe(el));
    } else {
        reveals.forEach((el) => el.classList.add('is-visible'));
    }

    // --- Simple gallery lightbox -------------------------------------
    const lightbox = document.querySelector('[data-lightbox]');
    if (lightbox) {
        const img = lightbox.querySelector('img');
        document.querySelectorAll('[data-lightbox-src]').forEach((thumb) => {
            thumb.addEventListener('click', () => {
                img.src = thumb.getAttribute('data-lightbox-src');
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
            });
        });
        lightbox.addEventListener('click', () => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        });
    }

    // --- Back to top button ---------------------------------------
    const toTop = document.querySelector('[data-back-to-top]');
    if (toTop) {
        const toggleTop = () => {
            if (window.scrollY > 500) {
                toTop.classList.remove('hidden');
                toTop.classList.add('flex');
            } else {
                toTop.classList.add('hidden');
                toTop.classList.remove('flex');
            }
        };
        toggleTop();
        window.addEventListener('scroll', toggleTop, { passive: true });
        toTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    }
});
