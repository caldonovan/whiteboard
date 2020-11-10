<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleUser extends Model
{
    use HasFactory;

    public function users()
    {
        $this->belongsToMany('App\Models\User');
    }

    public function modules()
    {
        $this->belongsToMany('App\Models\Module');
    }
}
