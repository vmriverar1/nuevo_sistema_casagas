<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlate extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plate_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_plates', 'plate_number', 'user_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'plate_id');
    }
}
