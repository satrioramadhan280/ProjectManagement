<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Role extends Model
{
    use HasFactory, Sortable;

    protected $sortable = [
        'display'
    ];
    public function users(){
        return $this->hasMany('App\Models\User', 'id', 'roleID');
    }
}
