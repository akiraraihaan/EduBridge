<?php

namespace App\Models;

use App\Models\Batch;
use App\Models\Module;
use App\Models\MentorCourse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'duration_months',
        'student_count',
        'max_students',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean'
    ];

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function mentors()
    {
        return $this->hasMany(MentorCourse::class);
    }

    public function students()
    {
        return $this->hasMany(User::class)->where('role_id', 3);
    }
}
