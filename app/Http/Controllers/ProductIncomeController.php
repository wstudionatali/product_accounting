<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIncome;
use Illuminate\Http\Request;

class ProductIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Product $product)
    {

        $product = $product->load('productIncomes');

        return view('incomes.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {

        $validatedData = $request->validate([
           'purchase_price'=> 'required|numeric|between:0,99999999|regex:/^\d+(\.\d{1,2})?$/',
           'income_quantity' => 'required|integer|min:1',
           'created_at' => 'required|date|before_or_equal:today|date_format:Y-m-d'  /* date should be in the format YYYY-MM-DD */
        ]);


        $productIncome = ProductIncome::where('product_id', $product->id)
                         ->where('purchase_price', $validatedData['purchase_price'])
                         ->whereDate('created_at', $validatedData['created_at'])
                         ->first();

        if ($productIncome) {

            $this->update($validatedData, $productIncome, $product);
            return redirect()->route('products.incomes.create', $product);
        } else {
            ProductIncome::create([
                'product_id' => $product->id,
                'income_quantity' => $validatedData['income_quantity'],
                'current_quantity' => $validatedData['income_quantity'],
                'purchase_price' => $validatedData['purchase_price']
            ]);
               return redirect()->route('products.incomes.create', $product);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $validatedData, ProductIncome $productIncome, Product $product)
    {
        $total_income_quantity = $productIncome->income_quantity;
        $total_income_quantity += $validatedData['income_quantity'];
        $total_current_quantity= $productIncome->current_quantity;
        $total_current_quantity += $validatedData['income_quantity'];
        $productIncome->update([
            'income_quantity' => $total_income_quantity,
            'current_quantity' => $total_current_quantity
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * check if no records with this poduct_income_id in Bill table
     */
    public function destroy(Product $product, ProductIncome $income)
    {
        /*  check if no records with this poduct_income_id in Bill table */
        if ( !$income->billCompositions()->exists() )
        {
        $income->delete();
        return redirect()->back()->with(
            'success',
            'Product lot removed.'
        );
        } else {
            return redirect()->back()->with(
                'success',
                'This product lot have not been removed because it has sellings.'
            );
        }
    }
}
