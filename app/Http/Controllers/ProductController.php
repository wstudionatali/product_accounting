<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $barcode = $request->barcode;
        if (!$barcode)
        {
          //TODO reading from google sheet.
        }
        if (strlen($barcode)<11)
        {
           $products = Product::where('barcode', 'like', $barcode . '%')->get();
        } else {
           $products = Product::barcode($barcode)->get();
        }


        //$products = Product::all()->barcode($barcode)->get();
        if ($products ->isEmpty())
        {
            Session::flash('barcode', $barcode);
            return redirect(route('products.create')) ;
        } else {
            return view('products.index', ['products' => $products, 'barcode' => $barcode]);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barcode = '';
        if (Session::has('barcode')) {
            $barcode = Session::get('barcode');
        }
        return view('products.create', compact('barcode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'barcode'=>'required|string|unique:products|max:50',
            'name' => 'required|string|max:200',
            'price' => 'required|numeric|between:0,99999999|regex:/^\d+(\.\d{1,2})?$/',
            'income_quantity' => 'required|integer|min:1',
            'purchase_price' => 'required|numeric|between:0,99999999|regex:/^\d+(\.\d{1,2})?$/'
             ]);

        $newProduct = Product::create(
            [
                'barcode'=>$validatedData['barcode'],
                'name' => $validatedData['name'],
                'price' => $validatedData['price']
            ]);

        $newProduct->productIncomes()->create([
                'income_quantity' => $validatedData['income_quantity'],
                'current_quantity' => $validatedData['income_quantity'],
                'purchase_price' => $validatedData['purchase_price']
            ]);

            return redirect()->route('products.incomes.create', $newProduct)->with('success', 'Your product was created!');
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
    public function edit(Product $product)
    {

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'price' => 'required|numeric|between:0,99999999|regex:/^\d+(\.\d{1,2})?$/',
         ]);

         $product->update([
            'name' =>$validatedData['name'],
            'price' =>$validatedData['price'],
         ]);
         return redirect()->route('products.index')->with('success', 'Your product was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
          /* check if no records with this poduct_id in product_income table */
        if (!$product->productIncomes()->exists())
        {
          $product->delete();

          return redirect()->back()->with(
            'success',
            'Product removed.'
           );
        } else {
          return redirect()->back()->with(
            'success',
            'Product can not be removed because it has related lots(incomes)'
           );
        }
    }
}
