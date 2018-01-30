<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user'; // overwrite 'users' to 'user'
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
