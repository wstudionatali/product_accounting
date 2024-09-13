<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillComposition extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function bill() :BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
}
