@props(['title' => null, 'description' => null, 'image' => null])

@php
    $siteName = 'Pixies Bridal Saloon';
    $fullTitle = $title ? $title.' — '.$siteName : $siteName.' — Premium Bridal Beauty in Arusha';
    $desc = $description ?? 'Pixies Bridal Saloon — premium bridal makeup, hairstyling, nails and spa services in Arusha, Tanzania. Book your appointment today.';
    $ogImage = asset($image ?? 'images/afr-woman.jpg');
    $url = url()->current();
@endphp

<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $desc }}">
<link rel="canonical" href="{{ $url }}">
<meta name="theme-color" content="#1a1a1a">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $desc }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:locale" content="en_US">

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $desc }}">
<meta name="twitter:image" content="{{ $ogImage }}">

{{-- Favicons --}}
<link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

{{-- Local business structured data --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BeautySalon',
    'name' => $siteName,
    'image' => $ogImage,
    'url' => config('app.url'),
    'telephone' => config('site.phone'),
    'email' => config('site.email'),
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Arusha',
        'addressCountry' => 'TZ',
    ],
    'priceRange' => 'TSh',
], JSON_UNESCAPED_SLASHES) !!}
</script>

{{-- Analytics (only when configured) --}}
@if (config('site.analytics_ga_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('site.analytics_ga_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('site.analytics_ga_id') }}');
    </script>
@endif
