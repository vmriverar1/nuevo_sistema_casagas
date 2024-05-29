<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'email',
        'cun',
        'ruc',
        'main_address',
        'secondary_address',
        'main_phone',
        'secondary_phone',
        'photo',
        'status',
        'branch_type',
        'notes',
        'data'
    ];

    protected $casts = [
        'data' => 'array',
        'status' => 'string',
        'branch_type' => 'string',
        'email' => 'string',
        'photo' => 'string',
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function setCompanyNameAttribute($value)
    {
        $this->attributes['company_name'] = strtolower($value);
    }

    public function getCompanyNameAttribute($value)
    {
        return ucwords($value);
    }

    // Existing relationship
    public function usersAdmin()
    {
        return $this->belongsToMany(User::class, 'admin_branch', 'branch_id', 'user_id')
                    ->withTimestamps();
    }

    // New relationship
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_branch', 'branch_id', 'user_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    /**
     * Scope a query to only include active branches.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'eliminado');
    }
}
