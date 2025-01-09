@props([
'heading' => 'Are you sure?',
'message' => '',
'route' => '',
'model' => '',
'method' => 'delete',
'url' => null,
])
<form method="post" action="{{ $url ?? route($route, $model) }}"
      class="p-6">
    @csrf
    @method($method)

    <h2 class="text-lg font-medium text-gray-900">
        {{ $heading }}
    </h2>

    @if($message)
        <p class="mt-1 text-sm text-gray-600">
            {{ $message }}
        </p>
    @endif

    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ml-3">
            {{ __('Confirm') }}
        </x-danger-button>
    </div>
</form>
