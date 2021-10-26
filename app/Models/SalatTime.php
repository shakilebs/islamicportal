<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalatTime extends Model
{
    use HasFactory;

    function userName(){
        return $this->belongsTo(User::class, 'created_by','id');
    }
}
