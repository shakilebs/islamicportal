<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public function serviceName(){
        return $this->belongsTo(ServiceName::class, 'service_id', 'id');
        
    }
}
