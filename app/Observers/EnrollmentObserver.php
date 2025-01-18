<?php

namespace App\Observers;

use App\Models\Enrollment;

class EnrollmentObserver
{
    /**
     * Handle the Enrollment "created" event.
     */
    public function created(Enrollment $enrollment): void
    {
        $batch = $enrollment->batch;
        $batch->increment('enrolled_count');
    }

    /**
     * Handle the Enrollment "deleted" event.
     */
    public function deleted(Enrollment $enrollment): void
    {
        $batch = $enrollment->batch;
        $batch->decrement('enrolled_count');
    }
}
