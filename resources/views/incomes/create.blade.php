<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Warehouse. Add lots') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>{{ __('Product name') }}</th>
                            <th>{{ __('Barcode') }}</th>
                            <th>{{ __('Product price') }}</th>
                           </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->barcode }}</td>
                            <td>{{ $product->price }}</td>
                          </tr>
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('products.incomes.store', $product) }}">
                        @csrf
                        <table class="table">
                            <thead>
                              <tr>
                                <th> <label for="created_at">{{ __('Date') }}</label></th>
                                <th> <label for="purchase_price">{{ __('Purchase price') }}</label></th>
                                <th> <label for="income_quantity">{{ __('Income quantity') }}</label></th>
                               </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><input type="text" name="created_at" value="{{ now()->format('Y-m-d')}}"></td>
                                <td><input type="text" name="purchase_price"></td>
                                <td><input type="text" name="income_quantity"></td>
                              </tr>
                            </tbody>
                        </table>

                        <button type="submit" class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900">{{ __('Save') }}</button>
                      </form>
                      <button class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900" onclick="history.back();">{{ __('Go back') }}</button>
                    <table class="table">
                      <thead>
                        <tr>
                           <th>{{ __('Date') }}</th>
                           <th>{{ __('Purchase price') }}</th>
                           <th>{{ __('Income') }}</th>
                           <th>{{ __('Action') }}</th>
                         </tr>
                      </thead>
                      <tbody>

                        @foreach ($product->productIncomes as $income)
                         <tr>
                           <td>{{ $income->created_at}}</td>
                           <td>{{ $income->purchase_price }}</td>
                           <td>{{ $income->income_quantity }}</td>
                           <td>
                               @if ( !$income->billCompositions()->exists() )
                               <form action="{{ route('products.incomes.destroy', ['product' => $product->id, 'income' => $income->id]) }}" method="POST">
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
