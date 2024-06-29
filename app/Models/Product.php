<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'barcode', 'supplier_code', 'photo',
        'purchase_price', 'sale_price', 'sales', 'valuated', 'date',
        'stock', 'minimum', 'type', 'branch_id', 'brand_id', 'data'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id')
                    ->withTimestamps();
    }

    public function productsInPackage()
    {
        return $this->belongsToMany(Product::class, 'packages', 'package_id', 'product_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'product_requirements', 'product_id', 'requirement_id')
                    ->withTimestamps();
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_products', 'sale_id', 'producto_id')
                    ->withPivot(['quantity','url'])
                    ->withTimestamps();
    }
}
