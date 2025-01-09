<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data"
                      class="px-4 py-4 max-w-xl">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Product Name')"/>
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                      :value="old('name', $product->name)" required autofocus/>
                        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-4">
                        <x-input-label for="qty" :value="__('Quantity')"/>
                        <x-text-input id="qty" name="qty" type="number" class="mt-1 block w-full"
                                      :value="old('qty', $product->qty)" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('qty')"/>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <x-input-label for="price" :value="__('Price')"/>
                        <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full"
                                      :value="old('price', $product->price)" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('price')"/>
                    </div>

                    <!-- Thumbnail -->
                    <div class="mb-6">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')"/>
                        <input type="file" name="thumbnail" accept="image/*" class="mt-1 block w-full">
                        <x-input-error class="mt-2" :messages="$errors->get('thumbnail')"/>
                        @if($product->thumbnail)
                            <img class="mt-4 w-24 h-24 object-cover rounded"
                                 src="{{ $product->getImagePath('thumbnail') }}" alt="Thumbnail Preview">
                        @endif
                    </div>

                    <!-- Gallery -->
                    <div class="mb-6">
                        <x-input-label for="gallery" :value="__('Gallery')"/>
                        <input type="file" name="gallery[]" multiple accept="image/*" class="mt-1 block w-full">
                        <x-input-error class="mt-2" :messages="$errors->get('gallery')"/>
                        <div class="gallery-grid grid grid-cols-3 gap-4 mt-4">
                            @foreach($product->productGallery as $gallery)
                                <div class="gallery-item flex flex-col items-center">
                                    <img src="{{ $gallery->getImagePath('image') }}"
                                         class="w-24 h-24 object-cover rounded" alt="Gallery Image">
                                    <x-danger-button class="mt-2" x-data=""
                                                     x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion-{{ $gallery->id }}')"
                                                     aria-label="Delete Image">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                    <x-modal name="confirm-product-deletion-{{ $gallery->id }}" focusable>
                                        <x-delete-form heading="Are you sure you want to delete this gallery image?"
                                                       :model="$gallery" route="product.gallery.delete"/>
                                    </x-modal>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <x-input-label for="description" :value="__('Description')"/>
                        <textarea id="description" name="description" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border rounded-lg"
                                  placeholder="Write your thoughts here..."
                                  required>{{ old('description', $product->description ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
