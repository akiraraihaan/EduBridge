<?php

namespace App\Observers;

use App\Models\Enrollment;
use App\Models\Course;

class EnrollmentObserver
{
    public function created(Enrollment $enrollment)
    {
        // Increment student_count di course yang dipilih
        $user = $enrollment->user;
        if ($user && $user->course) {
            $user->course->increment('student_count');
        }

        // Update enrolled_count di batch berdasarkan total student_count dari semua course
        $enrollment->batch->update([
            'enrolled_count' => Course::sum('student_count')
        ]);
    }

    public function deleted(Enrollment $enrollment)
    {
        // Decrement student_count di course yang dipilih
        $user = $enrollment->user;
        if ($user && $user->course) {
            $user->course->decrement('student_count');
        }

        // Update enrolled_count di batch berdasarkan total student_count dari semua course
        $enrollment->batch->update([
            'enrolled_count' => Course::sum('student_count')
        ]);
    }
}
