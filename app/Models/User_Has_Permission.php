<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Has_Permission extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongTo(User::class);
    }
}