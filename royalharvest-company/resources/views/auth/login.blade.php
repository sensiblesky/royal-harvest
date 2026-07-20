<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — Royal Harvest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen grid lg:grid-cols-2">
    <div class="hidden lg:block bg-cover bg-center relative" style="background-image:url('{{ asset('images/bg_5.jpg') }}')">
        <div class="absolute inset-0 bg-charcoal-950/60"></div>
        <div class="absolute bottom-12 left-12 text-white">
            <p class="font-display text-4xl font-semibold">Royal <span class="text-gold-400">Harvest</span></p>
            <p class="text-white/70 mt-2 tracking-widest uppercase text-xs">Admin Portal</p>
        </div>
    </div>

    <div class="flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="font-display text-4xl font-semibold text-charcoal-900">Welcome back</h1>
                <p class="text-charcoal-400 mt-2">Sign in to manage the academy.</p>
            </div>

            <div class="space-y-4 mb-6"><x-ui.flash /></div>

            <form action="{{ route('login.attempt') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="text-sm text-charcoal-700 mb-1.5 block">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required autofocus class="field" placeholder="admin@royalharvest.co.tz">
                </div>
                <div>
                    <label class="text-sm text-charcoal-700 mb-1.5 block">Password</label>
                    <input name="password" type="password" required class="field" placeholder="••••••••">
                </div>
                <label class="flex items-center gap-2 text-sm text-charcoal-400">
                    <input type="checkbox" name="remember" class="rounded border-charcoal-100 text-gold-400 focus:ring-gold-400"> Remember me
                </label>
                <button class="btn-gold w-full">Sign In</button>
            </form>

            <a href="{{ route('home') }}" class="block text-center mt-6 text-xs uppercase tracking-widest text-charcoal-400 hover:text-gold-500">← Back to site</a>
        </div>
    </div>
</body>
</html>
