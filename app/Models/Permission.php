<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function user_has_permission(){
        return $this->hasMany(User_Has_Permission::class,'permission_id');
    }
}
