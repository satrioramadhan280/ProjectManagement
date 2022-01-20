<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = ['id', 'notification_type_id', 'user_id', 'assign_project_id', 'assign_task_id', 'status'];

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
