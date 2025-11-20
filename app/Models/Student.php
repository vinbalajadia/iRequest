<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'student_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'course',
        'year_level',
        'contact_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verfied_at' => 'datetime',
        'password' => 'hashed',
        'year_level' => 'integer',
    ];

    public function documentRequest()
    {
        return $this->hasMany(DocumentRequest::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . ($this->middle_name ? $this->middle_name . ' ' : '') . $this->last_name;
    }

    public function getInitialsAttribute()
    {
        return strtoupper(substr($this->first_name, 0, 1) . ($this->middle_name ? substr($this->middle_name, 0, 1) : '') . substr($this->last_name, 0, 1));
    }

    public function scopeByCourse($query, $course)
    {
        return $query->where('course', $course);
    }

    public function scopeByYearLevel($query, $yearLevel)
    {
        return $query->where('year_level', $yearLevel);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function hasActiveRequests()
    {
        return $this->documentRequest()
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
    }

    public function getTotalRequestCount()
    {
        return $this->documentRequest()->count();
    }

    public function getPendingRequestCount()
    {
        return $this->documentRequest()
            ->where('status', 'pending')
            ->count();
    }

    public function getCompletedRequestCount()
    {
        return $this->documentRequest()
            ->where('status', 'completed')
            ->count();
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
