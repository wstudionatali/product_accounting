<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'price', 'barcode'];
    use HasFactory;

    public function productIncomes() :HasMany
    {
        return $this->HasMany(ProductIncome::class);
    }
    public function sales() :HasMany
    {
        return $this->HasMany(Sale::class);
    }

    public function scopeBarcode(Builder|QueryBuilder $query, ?string $barcode): Builder|QueryBuilder
    {
        return $query->when($barcode, function (Builder|QueryBuilder $query, ?string $barcode) {
                $query->where('barcode',  $barcode);
            });
    }

}
