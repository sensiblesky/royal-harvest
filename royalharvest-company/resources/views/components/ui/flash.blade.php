@if (session('message'))
    <div class="rounded-xl bg-gold-50 border border-gold-200 text-gold-800 px-5 py-4 text-sm">
        {{ session('message') }}
    </div>
@endif

@if ($errors->any())
    <div class="rounded-xl bg-red-50 border border-red-200 text-red-700 px-5 py-4 text-sm">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
