<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'responsible',
        'total',
        'change',
        'photograph',
        'justification',
        'branch_id',
        'petty_cashes_id',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
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
     * La relación con el modelo PettyCash.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pettyCash()
    {
        return $this->belongsTo(PettyCash::class, 'petty_cashes_id');
    }
}
