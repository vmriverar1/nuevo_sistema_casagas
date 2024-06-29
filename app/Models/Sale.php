<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'customer_id',
        'seller_id',
        'amount',
        'tax',
        'discount',
        'accounting_document_id',
        'total',
        'change',
        'branch_id',
        'plate_id',
        'petty_cashes_id',
        'accounting_document_code'
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'change' => 'decimal:2',
    ];

    /**
     * La relación con el modelo Branch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * La relación con el modelo Plate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plate()
    {
        return $this->belongsTo(UserPlate::class, 'plate_id');
    }

    /**
     * La relación con el modelo User para el cliente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * La relación con el modelo User para el vendedor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * La relación con el modelo AccountingDocument.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountingDocument()
    {
        return $this->belongsTo(AccountingDocument::class);
    }

    /**
     * La relación con el modelo PettyCash.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pettyCash()
    {
        return $this->belongsTo(PettyCash::class, 'petty_cashes_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_products', 'sale_id', 'product_id')
                    ->withPivot(['quantity','url']);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'sale_discounts', 'sale_id', 'discount_id')
                    ->withPivot(['total'])
                    ->withTimestamps();
    }

    public function requirements()
    {
        return $this->belongsToMany(Product::class, 'sale_requirements', 'sale_id', 'requirement_id')
                    ->withTimestamps();
    }

    public function payment_methods()
    {
        return $this->belongsToMany(Product::class, 'sale_payment_methods', 'sale_id', 'payment_method_id')
                    ->withPivot(['total', 'data'])
                    ->withTimestamps();
    }

    public function advances()
    {
        return $this->hasMany(SaleAdvance::class);
    }
}
