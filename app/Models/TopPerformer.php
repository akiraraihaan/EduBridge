<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopPerformer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'batch_id',
        'final_score',
        'rank',
        'achievement_note'
    ];

    protected $casts = [
        'final_score' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
