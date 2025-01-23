<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Course;
use App\Models\Submission;
use App\Models\MentorCourse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'email',
        'whatsapp',
        'password',
        'role_id',
        'is_active',
        'profile_image',
        'bio',
        // Student fields
        'profession',
        'course_id',
        'reason',
        // Mentor fields
        'education_background',
        'certifications_file',
        'preferred_course',
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
        'is_active' => 'boolean',
        'birth_date' => 'date',
    ];

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user has the given role(s)
     * @param string|array $roles
     */
    public function hasRole($roles): bool
    {
        if (is_string($roles)) {
            $roles = explode(',', $roles);
        }

        foreach ($roles as $role) {
            $roleId = match (trim($role)) {
                'admin' => 1,
                'mentor' => 2,
                'student' => 3,
                default => null
            };

            if ($roleId && $this->role_id === $roleId) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the course that owns the user (for students).
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the preferred course for teaching (for mentors).
     */
    public function preferredCourse()
    {
        return $this->belongsTo(Course::class, 'preferred_course');
    }

    /**
     * Get the mentor courses for the user.
     */
    public function mentorCourses()
    {
        return $this->hasMany(MentorCourse::class);
    }

    /**
     * Get the submissions for the user.
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    /**
     * Check if user is mentor
     */
    public function isMentor(): bool
    {
        return $this->role_id === 2;
    }

    /**
     * Check if user is student
     */
    public function isStudent(): bool
    {
        return $this->role_id === 3;
    }

    public function getAge()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function isEligibleForRole(): bool
    {
        $age = $this->getAge();

        if ($this->isStudent()) {
            return $age >= 17 && $age <= 30;
        }

        if ($this->isMentor()) {
            return $age >= 17;
        }

        return true;
    }
}
