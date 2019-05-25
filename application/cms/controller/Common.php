<?php
namespace app\cms\controller;
use think\Controller;


class Common extends Controller
{
    protected function initialize()
    {
        $this->islog();
    }

    private function islog(){
        if (empty(session('islog'))) {
            $this->error('请先登陆', 'cms/login/index');
        }
    }



}
