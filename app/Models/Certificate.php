<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'certificate_number',
        'file_path',
        'type',
        'description',
        'issued_date'
    ];

    protected $casts = [
        'issued_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
