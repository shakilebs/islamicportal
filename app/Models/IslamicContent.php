<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslamicContent extends Model
{
    use HasFactory;

    protected $fillable = ['content_id','cat_id','file_name','content_title','content_title_bn','content_type','content_type_id'];
}
