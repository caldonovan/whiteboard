<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleUser extends Model
{
    public function users() {
        $this->belongsToMany('App\User');
    }

    public function modules() {
        $this->belongsToMany('App\Module');
    }
}
