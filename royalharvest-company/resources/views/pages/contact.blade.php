<x-layouts.app title="Contact">
    <x-ui.page-hero title="Get in Touch" image="images/salon-interior.jpg" crumb="Contact us">
        We'd love to hear from you.
    </x-ui.page-hero>

    <section class="py-24">
        <div class="container-x grid lg:grid-cols-2 gap-14">
            {{-- Info --}}
            <div>
                <x-ui.section-heading eyebrow="Contact" title="Let's talk beauty" align="left">
                    Questions about our programmes or enrolment? We are here to help.
                </x-ui.section-heading>

                <div class="mt-10 space-y-6">
                    @foreach ([['Address', config('site.address')], ['Phone', config('site.phone')], ['Email', config('site.email')]] as [$label, $value])
                        <div class="flex items-start gap-4">
                            <span class="mt-1 w-11 h-11 shrink-0 grid place-items-center rounded-full bg-gold-50 text-gold-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9" /></svg>
                            </span>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-charcoal-400">{{ $label }}</p>
                                <p class="text-charcoal-800">{{ $value }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Form --}}
            <div class="bg-white rounded-2xl shadow-xl border border-charcoal-100/60 p-8 lg:p-10">
                <div class="space-y-4 mb-6"><x-ui.flash /></div>
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Your name</label>
                            <input name="name" value="{{ old('name') }}" required class="field" placeholder="Jane Doe">
                        </div>
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Email</label>
                            <input name="email" type="email" value="{{ old('email') }}" required class="field" placeholder="you@email.com">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Subject</label>
                        <input name="subject" value="{{ old('subject') }}" required class="field" placeholder="How can we help?">
                    </div>
                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Message</label>
                        <textarea name="body" rows="5" required class="field" placeholder="Tell us more...">{{ old('body') }}</textarea>
                    </div>
                    <button class="btn-gold w-full">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.app>
