<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    const COMPLETED = 'completed';
    const PENDING = 'pending';
    
    protected $fillable = [
        'name_task', 'status', 'created_at', 'updated_at'
    ];

    public function scopeStatusNot(Builder $query, string $status)
    {
        return $query->where('status', '!=', $status);
    }
}
