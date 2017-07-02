<?php

namespace app\bis\controller;

use think\Controller;
use think\Request;

class Register extends Controller
{

    /**
     * 显示资源列表
     * @return \think\Response
     */
    public function index()
    {
        $citys=model('City')->getNormalCity();
        $categorys=model('Category')->getNormalCategory();
        $this->assign([
            'citys'=>$citys,
            'categorys'=>$categorys
        ]);
        return $this->fetch();
    }


}
