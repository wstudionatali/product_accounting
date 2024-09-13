<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductIncome;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     */
    public function run(): void
    {
    /**
     * Seed tables user_roles and users with 1-st admin user
     */

    $admin_id = DB::table('user_roles')->insertGetId(
        [
        'role' =>  env('ADMINISTRATOR', 'admin'),
        ],
        );
    DB::table('user_roles')->insert([
        [
        'role' =>  env('STOREKEEPER', 'storekeeper'),
            ],
        [
        'role' =>  env('SALES_MANAGER', 'sales_manager'),
        ],
        [
        'role' =>  env('SALESMAN', 'salesman'),
        ],
    ]);

    User::factory()->create([
        'name' => 'Natalia',
        'email' => 'wstudionatali@gmail.com',
        'password' => Hash::make('admin'),
        'user_role_id' => $admin_id,
    ]);

      User::factory(4)->create(['password' => Hash::make('password')]);
      /**
       * products and product_incomes seeding
       */
      $id  = 0;

      $all_products = Product::factory(50)->create()->each(function ($product) use(&$id){
        $numIncoms = random_int(1, 3);
        $products_prices_variants = 0;


        ProductIncome::factory()->count($numIncoms)
            ->for($product)
            ->create()->each(function ($productIncome) use ($product, &$id, &$products_prices_variants) {
                $products_prices_variants = (($id) && ($id === $product->id))?$products_prices_variants:fake()->numberBetween(10, 1000);
                $lots_prices_varriants = 1 + rand(-2, 2) / 100;

                $productIncome->current_quantity = $productIncome->income_quantity;
                $productIncome->purchase_price = $products_prices_variants*$lots_prices_varriants;

                //info('variation='.$products_prices_variants.' id='.$id.' prod_id='.$product->id.' price='.$products_prices_variants*(1 + rand(-2, 2) / 100));
                $id = $product->id;
                $productIncome->save();
            });
      });

        $maxPrices = ProductIncome::groupBy('product_id')->selectRaw('product_id, MAX(purchase_price) as max_price')->get();

        foreach ($all_products as $product  ) {
            $maxPrice = $maxPrices->where('product_id', $product->id)->first();
            if ($maxPrice) {
                $product->update(['price' => $maxPrice->max_price*1.15]);
            }
        }
    }
}
