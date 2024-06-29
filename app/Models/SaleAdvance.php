<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleAdvance extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'advance_amount', 'change'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
