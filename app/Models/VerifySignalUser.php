<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifySignalUser extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'token',
    ];


    public function signalUser(){
        return $this->belongsTo(Signal_User::class,'user_id');
    }
}
