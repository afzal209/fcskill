<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'signal_text',
        'signal_type',
    ];
}
