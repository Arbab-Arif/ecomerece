<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data"
                      class="px-4 py-4 max-w-xl">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Product Name')"/>
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                      :value="old('name')"
                                      required autofocus/>
                        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="qty" :value="__('Quantity')"/>
                        <x-text-input id="qty" name="qty" type="number" class="mt-1 block w-full"
                                      :value="old('qty')" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('qty')"/>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')"/>
                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full"
                                      :value="old('price')" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('price')"/>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="thumbnail " :value="__('Thumbnail')"/>
                        <input type="file" name="thumbnail" accept="image/*">
                        <x-input-error class="mt-2" :messages="$errors->get('thumbnail')"/>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="gallery" :value="__('Gallery')"/>
                        <input type="file" name="gallery[]" multiple accept="image/*">
                        <x-input-error class="mt-2" :messages="$errors->get('gallery')"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')"/>
                        <textarea id="description" name="description" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  placeholder="Write your thoughts here..." required>{{old('description')}}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        <x-primary-button>{{ __('Create') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
