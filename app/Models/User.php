<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'user',
        'username',
        'password',
        'email',
        'img',
        'role_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }

    public function warga()
    {
        return $this->hasOne(DataWarga::class, 'nama', 'user');
    }
}
