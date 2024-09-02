<?php

use App\Models\Bill;
use App\Models\ProductIncome;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bill_compositions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProductIncome::class)->constrained();
            $table->foreignIdFor(Bill::class)->constrained();
            $table->unsignedInteger('quantity');
            $table->decimal('payed_price', total: 8, places: 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_compositions');
    }
};
