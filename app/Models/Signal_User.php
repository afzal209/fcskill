<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Signal_User extends Model
{
   use HasApiTokens, HasFactory, Notifiable;

   protected $fillable =[
      'name',
      'email',
      'password',
   ];

   protected $casts = [
      'email_verified_at' => 'datetime',
  ];

   public function verifySignalUser(){
      return $this->hasOne(VerifySignalUser::class,'user_id');
   }
}
