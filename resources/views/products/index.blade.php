<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Warehouse') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="GET" id="myForm" action="{{ route('products.index') }}">
                        @csrf
                        <label for="barcode">{{ __('Barcode') }}</label>
                        <input type="text" name="barcode"  id="barcode" value="{{  old('barcode',  $barcode) }}">
                        <button type="submit" class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900">{{ __('Read barcode') }}</button>
                        <button class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900" onclick="document.getElementById('barcode').value = ''; this.form.submit();">{{ __('Clear') }}</button>
                      </form>
                    <table class="table">
                      <thead>
                        <tr>
                           <th class="px-10">barcode</th>
                           <th>Product</th>
                           <th>Price</th>
                         </tr>
                      </thead>
                      <tbody>

                        @foreach ($products as $product)
                         <tr>
                            <td>{{ $product->barcode }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                               <a class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900" href="{{ route('products.edit', $product) }}"> {{ __('Edit') }}</a>
                               <a class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900" href="{{ route('products.incomes.create', $product) }}"> {{ __('Add lot') }}</a>

                               @if (!$product->productIncomes()->exists())
                                  <form class="inline-block" action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900">{{ __('Delete') }}</button>
                                  </form>
                                @endif
                            </td>
                          </tr>
                        @endforeach

                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
