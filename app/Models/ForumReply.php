<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;
    protected $table = 'forum_reply';
    protected $fillable = ['id', 'forum_id', 'user_id', 'description'];
}
