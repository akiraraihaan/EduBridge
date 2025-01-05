<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'content',
        'file_path',
        'type',
        'order',
        'status'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
