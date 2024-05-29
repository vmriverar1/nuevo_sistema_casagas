<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'supplier_id',
        'seller_id',
        'net',
        'discount',
        'accounting_document_id',
        'total',
        'petty_cashes_id',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'net' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
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
     * La relación con el modelo User para el proveedor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
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
        return $this->belongsToMany(Product::class, 'purchase_products', 'purchase_id', 'producto_id')
                    ->withPivot(['quantity'])
                    ->withTimestamps();
    }

    public function requirements()
    {
        return $this->belongsToMany(Product::class, 'purchase_requirements', 'purchase_id', 'requirement_id')
                    ->withTimestamps();
    }

    public function payment_methods()
    {
        return $this->belongsToMany(Product::class, 'purchase_payment_methods', 'purchase_id', 'payment_method_id')
                    ->withPivot(['total', 'data'])
                    ->withTimestamps();
    }
}
