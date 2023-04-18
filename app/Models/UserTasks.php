<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTasks extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time',
        'end_time',
        'remarks',
        'user_id',
        'tasks_id',
        'status_id',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the specific task on user tasks.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Tasks::class);
    }

    /**
     * Get the specific status of task in user tasks.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

}
