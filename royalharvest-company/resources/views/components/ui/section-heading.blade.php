@props(['eyebrow' => null, 'title', 'align' => 'center', 'light' => false])

<div @class([
    'reveal',
    'text-center mx-auto max-w-2xl' => $align === 'center',
    'max-w-2xl' => $align === 'left',
])>
    @if ($eyebrow)
        <span class="eyebrow">{{ $eyebrow }}</span>
    @endif
    <h2 @class([
        'font-display text-4xl md:text-5xl font-semibold leading-tight',
        'text-white' => $light,
        'text-charcoal-900' => !$light,
    ])>{{ $title }}</h2>
    @if (trim($slot))
        <p @class([
            'mt-4 text-base leading-relaxed',
            'text-white/70' => $light,
            'text-charcoal-400' => !$light,
        ])>{{ $slot }}</p>
    @endif
    <div @class(['mt-6 h-px w-24 bg-gold-400', 'mx-auto' => $align === 'center'])></div>
</div>
