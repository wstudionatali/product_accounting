<?php

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
        Schema::create('sale_types', function (Blueprint $table) {
            $table->id();
            $table->char('sale_title', length: 100);
            $table->char('rule_type', length: 100);
            $table->unsignedInteger('rule_value');
            $table->char('condition', length: 100);
            $table->unsignedInteger('condition_value')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_types');
    }
};
