<x-layouts.app title="Apply">
    <x-ui.page-hero title="How to Apply" image="images/afr-woman.jpg" crumb="Admissions">
        Ready to begin? Fill in the form and our team will guide you through enrolment.
    </x-ui.page-hero>

    <section class="py-24">
        <div class="container-x grid lg:grid-cols-2 gap-14">
            {{-- Steps --}}
            <div>
                <x-ui.section-heading eyebrow="Enrolment" title="Three simple steps" align="left" />
                <div class="mt-10 space-y-8">
                    @foreach ([
                        ['1', 'Submit your application', 'Complete the form with your details and chosen programme.'],
                        ['2', 'We get in touch', 'Our admissions team will call or email to confirm and answer questions.'],
                        ['3', 'Start learning', 'Complete enrolment, join your cohort and begin your beauty journey.'],
                    ] as [$n, $title, $text])
                        <div class="flex gap-5">
                            <span class="shrink-0 w-11 h-11 grid place-items-center rounded-full bg-gold-400 text-charcoal-900 font-semibold">{{ $n }}</span>
                            <div>
                                <h3 class="text-lg font-semibold text-charcoal-900">{{ $title }}</h3>
                                <p class="text-sm text-charcoal-400 mt-1">{{ $text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Form --}}
            <div class="bg-white rounded-2xl shadow-xl border border-charcoal-100/60 p-8 lg:p-10">
                <h2 class="font-display text-3xl font-semibold text-charcoal-900 mb-6">Application form</h2>
                <div class="space-y-4 mb-6"><x-ui.flash /></div>
                <form action="{{ route('apply.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">First name *</label>
                            <input name="first" value="{{ old('first') }}" required class="field" placeholder="Jane">
                        </div>
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Last name *</label>
                            <input name="last" value="{{ old('last') }}" required class="field" placeholder="Doe">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Phone *</label>
                        <input name="phone" value="{{ old('phone') }}" required class="field" placeholder="07XXXXXXXX">
                    </div>
                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Email (optional)</label>
                        <input name="email" type="email" value="{{ old('email') }}" class="field" placeholder="you@email.com">
                    </div>
                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Programme *</label>
                        <select name="programme_id" required class="field">
                            <option value="" disabled selected>Choose a programme…</option>
                            @foreach ($programmes as $programme)
                                <option value="{{ $programme->id }}" @selected(old('programme_id') == $programme->id)>{{ $programme->name }} — {{ $programme->duration }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn-gold w-full">Submit Application</button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.app>
