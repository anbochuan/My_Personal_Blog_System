<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links'; // overwrite 'users' to 'user'
    protected $primaryKey = 'link_id';
    public $timestamps = false;
    protected $guarded = [];//排除法，把数据库中不想被填充的项列出来 相当于blacklist
}
