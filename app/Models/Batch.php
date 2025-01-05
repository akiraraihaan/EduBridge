<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\TopPerformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'year',
        'registration_start',
        'registration_end',
        'current_students',
        'is_open'
    ];

    protected $casts = [
        'registration_start' => 'date',
        'registration_end' => 'date',
        'is_open' => 'boolean'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function topPerformers()
    {
        return $this->hasMany(TopPerformer::class);
    }
}
