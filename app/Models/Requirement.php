<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_requirements', 'requirement_id', 'producto_id')
                    ->withTimestamps();
    }

    public function sales()
    {
        return $this->belongsToMany(Product::class, 'sale_requirements', 'sale_id', 'requirement_id')
                    ->withTimestamps();
    }
}
