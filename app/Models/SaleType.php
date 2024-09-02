<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleType extends Model
{
    use HasFactory;
    public $rule_types =  ['%', '$', 'pices'];
    public $conditions = ['unconditional', 'quantity', 'additional products', 'bundl'];
    public function sales() :HasMany
    {
        return $this->HasMany(Sale::class);
    }

}
