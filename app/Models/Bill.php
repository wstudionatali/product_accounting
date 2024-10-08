<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function billCompositions() :HasMany
    {
        return $this->HasMany(BillComposition::class);
    }
}
