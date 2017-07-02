<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\File;

class Image extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function upload()
    {
        $file=request()->file('file');
        $info = $file->move('upload');
        //print_r($info);die;
        if($info && $info->getPathname())
        {
          return show(1,'success','/'.$info->getPathname());

        }else{
            return show(0,'upload error');
        }


    }

}
