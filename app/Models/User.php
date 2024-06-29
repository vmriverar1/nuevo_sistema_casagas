<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'document',
        'document_type',
        'phone',
        'address',
        'birthday',
        'photo',
        'profile',
        'data'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login' => 'datetime',
        'data' => 'array',
        'birthday' => 'date'
    ];

    public function getBirthdayAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function branchesAdmmin()
    {
        return $this->belongsToMany(Branch::class, 'admin_branch', 'user_id', 'branch_id')
                    ->withTimestamps();
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'user_branch', 'user_id', 'branch_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    // Relación Many-to-Many con Role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
                    ->withTimestamps();
    }

    public function plates()
    {
        return $this->hasMany(UserPlate::class);
    }
}
