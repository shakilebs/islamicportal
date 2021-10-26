<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioContent extends Model
{
    use HasFactory;
    protected $fillable = ['content_id','cat_id','file_name','content_title','content_title_bn','content_type'];


    public function category(){
        return $this->belongsTo(Category::class, 'cat_id', 'id');
        
    }
    public function serviceName(){
        return $this->belongsTo(ServiceName::class, 'service_id', 'id');
        
    }
    
}
