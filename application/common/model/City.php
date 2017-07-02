<?php

namespace app\common\model;

use think\Model;

class City extends Model
{
    public function getNormalCity($parentId=0)
    {
        $data=[
            'status'=>1,
            'parent_id'=>$parentId,
        ];
        $order = [
            'id'=>'desc'

        ];
        $result = $this->where($data)
            ->order($order)
            ->select();
        return $result;

    }
}
