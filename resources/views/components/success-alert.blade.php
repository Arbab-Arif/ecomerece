@if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)"
        class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50"
        role="alert"
    >
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif
