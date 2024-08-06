<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'electronic_billing',
        'tax_type',
        'sale_percentage',
        'print_document',
        'prefix_numbering',
        'start_numbering',
        'mail_shipping',
        'branch_id',
    ];

    protected $casts = [
        'electronic_billing' => 'boolean',
        'sale_percentage' => 'decimal:2',
        'start_numbering' => 'integer',
        'mail_shipping' => 'boolean',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
