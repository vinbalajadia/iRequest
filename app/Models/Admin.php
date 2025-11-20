<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'department',
        'role',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    const ROLE_ADMIN = 'admin';
    const ROLE_STAFF = 'staff';

    const ROLES = [
        self::ROLE_ADMIN => 'Administrator',
        self::ROLE_STAFF => 'Staff',
    ];

    const DEPARTMENTS = [
        'registrar' => 'Registrars Office',
        'admin' => 'Administrator',
        'CS' => 'Computer Science',
    ];

    public function processedRequests()
    {
        return $this->hasMany(DocumentRequest::class, 'processed_by');
    }

    public function getRoleNameAttribute()
    {
        return self::ROLES[$this->role] ?? $this->role;
    }

    public function getDepartmentNameAttribute()
    {
        return self::DEPARTMENTS($this->department) ?? $this->department;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopebyDepartment($query, $department)
    {
        return $query->where('department', $department);
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', self::ROLE_ADMIN);
    }

    public function scopeStaffs($query)
    {
        return $query->where('role', self::ROLE_STAFF);
    }
}
