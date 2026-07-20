@props(['name' => 'sparkles', 'class' => 'w-6 h-6'])

@php
    $paths = [
        'crown' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.5 8l4 3 5-6 5 6 4-3-2 10H4.5l-2-10z"/>',
        'scissors' => '<circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path stroke-linecap="round" d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"/>',
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3l1.9 4.6L18.5 9.5 13.9 11.4 12 16l-1.9-4.6L5.5 9.5l4.6-1.9L12 3zM18 15l.9 2.1L21 18l-2.1.9L18 21l-.9-2.1L15 18l2.1-.9L18 15z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 20s-7-4.35-9.5-8.5C1 8.5 2.5 5 6 5c2 0 3 1.5 3 1.5S10 5 12 5s3 1.5 3 1.5S16 5 18 5c3.5 0 5 3.5 3.5 6.5C19 15.65 12 20 12 20z"/>',
        'leaf' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 20c0-8 6-14 16-14 0 10-6 14-14 14a10 10 0 01-2 0zM4 20c2-4 5-7 9-9"/>',
        'users' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 20v-1a4 4 0 00-4-4H7a4 4 0 00-4 4v1M9.5 11a3.5 3.5 0 100-7 3.5 3.5 0 000 7zM21 20v-1a4 4 0 00-3-3.87M15.5 4.13a4 4 0 010 7.75"/>',
    ];
    $svg = $paths[$name] ?? $paths['sparkles'];
@endphp

<svg class="{{ $class }}" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
    {!! $svg !!}
</svg>
