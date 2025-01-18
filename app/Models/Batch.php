<?php

namespace App\Models;

use App\Models\Enrollment;
use App\Models\TopPerformer;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'capacity',
        'is_active',
        'is_open',
        'enrolled_count'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'is_open' => 'boolean'
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'batch_user', 'batch_id', 'user_id')
            ->withTimestamps();
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function topPerformers()
    {
        return $this->hasMany(TopPerformer::class);
    }

    public function hasAvailableSlots()
    {
        return $this->enrolled_count < $this->capacity;
    }

    public function getAvailableSlotsAttribute()
    {
        return $this->capacity - $this->enrolled_count;
    }

    public function getStatusBadgeAttribute()
    {
        if (!$this->is_active) {
            return '<span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">Tidak Aktif</span>';
        }

        if ($this->is_open) {
            return '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Pendaftaran Dibuka</span>';
        }

        return '<span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pendaftaran Ditutup</span>';
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->capacity === 0) return 0;
        return round(($this->enrolled_count / $this->capacity) * 100);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOpen($query)
    {
        return $query->where('is_open', true);
    }
}
