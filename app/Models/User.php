<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // ✅ เพิ่ม role
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ----------------------------------------------------
    //  ฟังก์ชันตรวจสอบ role
    // ----------------------------------------------------
    public function hasRole($roles)
    {
        // ถ้าเป็น array เช่น ['admin', 'superadmin']
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }

        // ถ้าเป็น role เดี่ยว เช่น 'admin'
        return $this->role === $roles;
    }
}
