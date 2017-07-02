<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true;

    public function add($data)
    {
      //  halt($data);
        $validate=validate('Category');
        if(!$validate->scene('add')->check($data))
        {
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        $data['status']=1;
        $result=$this->save($data,$data['id']);
        if($result)
        {
            return ['valid'=>1,'msg'=>'添加成功'];
        }else{
            return ['valid'=>0,'msg'=>'添加失败'];
        }
    }
    public function getNormalFirstCategory()
    {
        $data=[
            'status'=>1,
            'parent_id'=>0
        ];
        $order = [
            'id'=>'desc'
        ];
      return  $this->where($data)
            ->order($order)
            ->select();
    }

    public function getFirstCategory($parentId=0)
    {
        $data=[
            'status'=>['neq',-1],
            'parent_id'=>$parentId
        ];
        $order = [
            'listorder'=>'desc',
            'id'=>'desc'

        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate(2);
        return $result;
    }

    public function getNormalCategory($parentId=0)
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
