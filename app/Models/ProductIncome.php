<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductIncome extends Model
{
    public $timestamps = true;

    const UPDATED_AT = null;
    protected $fillable = ['product_id', 'income_quantity', 'current_quantity', 'purchase_price', 'created_at' ];

    use HasFactory;


    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function billCompositions() :HasMany
    {
        return $this->hasMany(BillComposition::class);
    }
}
