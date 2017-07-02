<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Category extends Controller
{
    protected $db;
    public function _initialize()
    {
        parent::_initialize();
        $this->db=new \app\common\model\Category();

    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $parentId =input('get.parent_id',0,'intval');
        $categorys=$this->db->getFirstCategory($parentId);
        $this->assign([
            'categorys'=>$categorys,
        ]);
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        if(request()->isPost())
        {
           // halt($data);
            $data=input('post.');

            if(isset($data['id']))
            {
                $this->update($data);
            }else
            {
                $data['id']='';
            }
            $res=$this->db->add($data);
            if($res['valid'])
            {
                return $this->success($res['msg'],'index/index');
            }else
            {
                return $this->error($res['msg']);
            }
        }

        $categorys=$this->db->getNormalFirstCategory();
       // halt($categorys);
        $this->assign([
            'categorys'=>$categorys,
        ]);

       return $this->fetch();
    }

    /**
     * 修改
     * @param $id
     */

    public function edit($id=0)
    {
        //echo $id;
        if(intval($id) < 1)
        {
            $this->error('参数不合法');
        }
       $category= $this->db->get($id);
        $categorys=$this->db->getNormalFirstCategory();
       //  halt($categorys);
        $this->assign([
            'categorys'=>$categorys,
            'category'=>$category,
        ]);
      return  $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update($data)
    {
       // halt($data);
        $res=$this->db->save($data,['id'=>$data['id']]);
        if($res)
        {
            return $this->success('修改成功');

        }else{

            return $this->error('修改失败');
        }
    }

    public function listorder($id,$listorder)
    {
      $res = $this->db->save(['listorder'=>$listorder],['id'=>$id]);
       if($res)
       {
           $this->result($_SERVER['HTTP_REFERER'],1,'success');
       }else{
           $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
       }
    }

    public function status()
    {
        $data=input('get.');
        $validate=validate('Category');
        if(!$validate->scene('status')->check($data))
        {
            $this->error($validate->getError());

        }
        $res=$this->db->save(['status'=>$data['status']],['id'=>$data['id']]);
        if($res)
        {
            return $this->success('更新成功');
        }else
        {
            return $this->error('更新失败');
        }
    }

}
