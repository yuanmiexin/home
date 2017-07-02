<?php
namespace app\bis\controller;
use think\Controller;
use think\Request;

class Register extends Controller
{
    public function index()
    {
       return  $this->fetch();
    }
}
