<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'type',
        'markdown',
        'branch_id',
    ];

    public function sale()
    {
        return $this->belongsToMany(Sale::class, 'sale_discounts', 'discount_id', 'sale_id')
                    ->withPivot(['total'])
                    ->withTimestamps();
    }
}
