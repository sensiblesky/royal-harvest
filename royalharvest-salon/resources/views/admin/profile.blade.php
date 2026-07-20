<x-layouts.admin title="My Profile">
    <div class="max-w-2xl space-y-8">
        <div class="space-y-4"><x-ui.flash /></div>

        {{-- Profile details --}}
        <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-8">
            <h2 class="text-xl font-semibold text-charcoal-900 mb-6">Account details</h2>
            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-5">
                @csrf @method('PATCH')
                <div>
                    <label class="text-sm text-charcoal-700 mb-1.5 block">Name</label>
                    <input name="name" value="{{ old('name', $user->name) }}" required class="field">
                </div>
                <div>
                    <label class="text-sm text-charcoal-700 mb-1.5 block">Email</label>
                    <input name="email" type="email" value="{{ old('email', $user->email) }}" required class="field">
                </div>
                <button class="btn-gold">Save details</button>
            </form>
        </div>

        {{-- Change password --}}
        <div class="bg-white rounded-2xl border border-charcoal-100 shadow-sm p-8">
            <h2 class="text-xl font-semibold text-charcoal-900 mb-6">Change password</h2>
            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5">
                @csrf @method('PATCH')
                <div>
                    <label class="text-sm text-charcoal-700 mb-1.5 block">Current password</label>
                    <input name="current_password" type="password" autocomplete="current-password" required class="field">
                </div>
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">New password</label>
                        <input name="password" type="password" autocomplete="new-password" required class="field">
                    </div>
                    <div>
                        <label class="text-sm text-charcoal-700 mb-1.5 block">Confirm new password</label>
                        <input name="password_confirmation" type="password" autocomplete="new-password" required class="field">
                    </div>
                </div>
                <p class="text-xs text-charcoal-400">Use at least 8 characters.</p>
                <button class="btn-gold">Update password</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
