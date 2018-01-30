<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article'; // overwrite 'users' to 'user'
    protected $primaryKey = 'art_id';
    public $timestamps = false;
    protected $guarded = [];//排除法，把数据库中不想被填充的项列出来 相当于blacklist
}
