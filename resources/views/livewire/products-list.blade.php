<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-4 flex">
        <div>
            <x-input-label for="search" :value="__('Search:')" class="inline-block"/>
            <x-text-input id="search" name="search" type="text" class="mt-1 inline-block w-full"
                          wire:model.live.debounce="search"
                          autofocus/>
        </div>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>

                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Thumbnail
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody class="p-2">
            @forelse($products as $product)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $product->name }}
                    </th>

                    <td class="px-6 py-4">
                        {{ $product->qty }}
                    </td>
                    <td class="px-6 py-4">
                        ${{ number_format($product->price,2) }}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <img src="{{$product->getImagePath('thumbnail')}}" width="50" height="50" alt="">
                    </th>
                    <td class="px-6 py-4">
                        <x-primary-link href="{{ route('product.edit', $product) }}">
                            Edit
                        </x-primary-link>
                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion-{{ $product->id }}')"
                        >{{ __('Delete') }}</x-danger-button>
                        <x-modal name="confirm-product-deletion-{{ $product->id }}" focusable>
                            <x-delete-form
                                heading="Are you sure you want to delete this product?"
                                :model="$product"
                                route="product.destroy"
                            />
                        </x-modal>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b">
                    <td colspan="4">
                        <div
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert"
                        >
                            <span class="block sm:inline">No Products found!</span>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{--    @if($products->hasPages())--}}
    {{--        <div class="p-4">--}}
    {{--            {{ $products->links() }}--}}
    {{--        </div>--}}
    {{--    @endif--}}
</div>
