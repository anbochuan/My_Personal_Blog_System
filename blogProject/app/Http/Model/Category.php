<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category'; // overwrite 'users' to 'user'
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded = [];//排除法，把数据库中不想被填充的项列出来 相当于blacklist

    public function tree()
    {
        $categorys = $this->orderBy('cate_order', 'asc')->get();// get data from DB sort based on the cate_order in ascending order
        return $this->getTree($categorys, 'cate_name', 'cate_id', 'cate_pid', 0);
    }

    public function getTree($data, $field_name, $field_id='id', $field_pid='pid', $pid=0)
    {
        $resArray = array();
        foreach ($data as $k=>$v)
        {
            if($v->$field_pid == $pid)
            {
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $resArray[] = $data[$k];
                foreach ($data as $m=>$n)
                {
                    if($n->$field_pid == $v->$field_id)
                    {
                        $data[$m]["_".$field_name] = "|--- ".$data[$m][$field_name];
                        $resArray[] = $data[$m];
                    }
                }
            }
        }
        return $resArray;
    }
}
