<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Warehouse. Create product') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf
                        <div>{{ __('Barcode: ') }}<span>{{ $barcode }}</span></div>
                        <input type="text" name="barcode" value="{{  old('barcode',  $barcode)  }}">
                        <label for="name">{{ __('Product name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}">
                        <label for="price">{{ __('Price') }}</label>
                        <input type="text" name="price" value="{{ old('price') }}">
                        <label for="income_quantity">{{ __('Income quantity') }}</label>
                        <input type="text" name="income_quantity" value="{{ old('income_quantity') }}">
                        <label for="purchase_price">{{ __('Purchase price') }}</label>
                        <input type="text" name="purchase_price" value="{{ old('purchase_price') }}">
                        <button type="submit" class="btn h-10">{{ __('Save') }}</button>
                      </form>
                      <button class="btn h-10" onclick="history.back();">{{ __('Go back') }}</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
