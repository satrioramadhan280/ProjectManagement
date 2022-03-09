<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;
use App\Models\Status;

class Project extends Model
{
    use HasFactory;

    protected $attributes = [
        'status_id' => 1,
        'progress' => 0,
    ];
    protected $dates = ['startDate', 'endDate'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
