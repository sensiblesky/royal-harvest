<x-layouts.admin title="Payment & SMS Settings">
    <div class="max-w-3xl space-y-8">
        {{-- Status banner --}}
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="rounded-2xl border p-5 {{ $snippeConfigured ? 'bg-green-50 border-green-200' : 'bg-gold-50 border-gold-200' }}">
                <p class="text-xs uppercase tracking-widest {{ $snippeConfigured ? 'text-green-700' : 'text-gold-700' }}">Snippe Payments</p>
                <p class="mt-1 font-medium {{ $snippeConfigured ? 'text-green-800' : 'text-gold-800' }}">
                    {{ $snippeConfigured ? '✓ Configured — deposits can be collected' : 'Not configured — bookings fall back to enquiries' }}
                </p>
            </div>
            <div class="rounded-2xl border p-5 {{ $smsConfigured ? 'bg-green-50 border-green-200' : 'bg-gold-50 border-gold-200' }}">
                <p class="text-xs uppercase tracking-widest {{ $smsConfigured ? 'text-green-700' : 'text-gold-700' }}">Beem SMS</p>
                <p class="mt-1 font-medium {{ $smsConfigured ? 'text-green-800' : 'text-gold-800' }}">
                    {{ $smsConfigured ? '✓ Configured — confirmation SMS will send' : 'Not configured — no SMS will be sent' }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-8">
            <div class="space-y-4 mb-6"><x-ui.flash /></div>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                @csrf @method('POST')

                {{-- Snippe --}}
                <div>
                    <h2 class="text-xl font-semibold text-charcoal-900">Snippe (Payments)</h2>
                    <p class="text-sm text-charcoal-400 mt-1">Collect the {{ $depositPercent }}% booking deposit via mobile money & card.
                        <a href="https://docs.snippe.sh" target="_blank" class="text-gold-600 hover:underline">Snippe docs ↗</a>
                    </p>
                    <div class="mt-5 grid sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label class="text-sm text-charcoal-700 mb-1.5 block">API Key
                                @if ($settings['snippe_api_key_set'])<span class="text-green-600 text-xs">(set — leave blank to keep)</span>@endif
                            </label>
                            <input name="snippe_api_key" type="password" autocomplete="off" class="field" placeholder="snp_...">
                        </div>
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Base URL</label>
                            <input name="snippe_base_url" value="{{ $settings['snippe_base_url'] }}" class="field" placeholder="https://api.snippe.sh/v1">
                        </div>
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Currency</label>
                            <input name="snippe_currency" value="{{ $settings['snippe_currency'] }}" class="field" placeholder="TZS">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Webhook URL <span class="text-charcoal-400 text-xs">(must be HTTPS)</span></label>
                            <input name="snippe_webhook_url" value="{{ $settings['snippe_webhook_url'] }}" class="field" placeholder="https://your-domain.co.tz/webhooks/snippe">
                            <p class="text-xs text-charcoal-400 mt-2">
                                Set this to your public HTTPS URL ending in <code class="text-charcoal-700">/webhooks/snippe</code>, then
                                register the <strong>same URL</strong> in your
                                <a href="https://dashboard.snippe.sh" target="_blank" class="text-gold-600 hover:underline">Snippe dashboard ↗</a>.
                                Leave blank for local testing (payment is reconciled on return instead).
                            </p>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Webhook Secret
                                @if ($settings['snippe_webhook_secret_set'])<span class="text-green-600 text-xs">(set)</span>@endif
                            </label>
                            <input name="snippe_webhook_secret" type="password" autocomplete="off" class="field" placeholder="Used to verify webhooks (optional)">
                        </div>
                    </div>
                </div>

                {{-- Beem --}}
                <div class="border-t border-charcoal-100 pt-8">
                    <h2 class="text-xl font-semibold text-charcoal-900">Beem Africa (SMS)</h2>
                    <p class="text-sm text-charcoal-400 mt-1">Send booking confirmation SMS.
                        <a href="https://docs.beem.africa" target="_blank" class="text-gold-600 hover:underline">Beem docs ↗</a>
                    </p>
                    <div class="mt-5 grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">API Key
                                @if ($settings['beem_api_key_set'])<span class="text-green-600 text-xs">(set)</span>@endif
                            </label>
                            <input name="beem_api_key" type="password" autocomplete="off" class="field" placeholder="Beem API key (username)">
                        </div>
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Secret Key
                                @if ($settings['beem_secret_key_set'])<span class="text-green-600 text-xs">(set)</span>@endif
                            </label>
                            <input name="beem_secret_key" type="password" autocomplete="off" class="field" placeholder="Beem secret key">
                        </div>
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Sender ID</label>
                            <input name="beem_sender_id" value="{{ $settings['beem_sender_id'] }}" class="field" placeholder="SwalaTech">
                        </div>
                    </div>
                </div>

                {{-- Admin alerts --}}
                <div class="border-t border-charcoal-100 pt-8">
                    <h2 class="text-xl font-semibold text-charcoal-900">Admin Alerts</h2>
                    <p class="text-sm text-charcoal-400 mt-1">Get an SMS whenever a customer pays a booking deposit, so you can log in and confirm it.</p>
                    <div class="mt-5 grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-charcoal-700 mb-1.5 block">Alert phone number</label>
                            <input name="admin_alert_phone" value="{{ $settings['admin_alert_phone'] }}" class="field" placeholder="07XXXXXXXX">
                            <p class="text-xs text-charcoal-400 mt-2">Leave blank to disable payment alerts.</p>
                        </div>
                    </div>
                </div>

                <button class="btn-gold">Save settings</button>
            </form>
        </div>

        {{-- Test SMS --}}
        <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-8">
            <h2 class="text-lg font-semibold text-charcoal-900">Send a test SMS</h2>
            <p class="text-sm text-charcoal-400 mt-1">Verify your Beem credentials.</p>
            <form action="{{ route('admin.settings.test-sms') }}" method="POST" class="mt-4 flex flex-wrap gap-3">
                @csrf
                <input name="test_phone" class="field flex-1 min-w-[220px]" placeholder="07XXXXXXXX" required>
                <button class="btn-dark">Send test</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
