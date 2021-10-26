<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    use HasFactory;
    
    public function category(){
        return $this->belongsTo(Category::class, 'cat_id', 'id');
        
    }
    public function serviceName(){
        return $this->belongsTo(ServiceName::class, 'service_id', 'id');
        
    }
}
