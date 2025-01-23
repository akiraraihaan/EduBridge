<?php

namespace App\Models;

use App\Models\Module;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'due_date',
        'max_score',
        'status'
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_final_project' => 'boolean'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
