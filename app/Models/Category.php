<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['cat_name','cat_name_bn','cat_code','content_type','status'];

    public function audioContents(){
        return $this->hasMany(AudioContent::class);
    }
}
