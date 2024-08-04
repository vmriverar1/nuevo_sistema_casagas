<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'branch_id',
    ];

    protected $casts = [
        'branch_id' => 'integer',
    ];

    // Relación con Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Relación Many-to-Many con User
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user')
                    ->withPivot('assigned_at')
                    ->withTimestamps();
    }
}
