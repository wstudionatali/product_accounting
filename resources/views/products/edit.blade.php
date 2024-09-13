<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Warehouse. Update product') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('products.update', $product) }}">
                        @csrf
                        @method('PUT')
                        <div>{{ __('Barcode: ') }}<span>{{ $product->barcode }}</span></div>
                        <label for="name">{{ __('Product name') }}</label>
                        <input type="text" name="name" value="{{ $product->name }}">
                        <label for="price">{{ __('Price') }}</label>
                        <input type="text" name="price" value="{{ $product->price }}">
                        <button type="submit" class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900">{{ __('Save') }}</button>
                      </form>
                      <button class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900" onclick="history.back();">{{ __('Go back') }}</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
