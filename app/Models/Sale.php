<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    public function saleType() :BelongsTo
    {
        return $this->belongsTo(SaleType::class);
    }
    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
