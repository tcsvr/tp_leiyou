<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;

class Common extends Controller
{
    protected function initialize()
    {
        $nid = Request::param('nid', 1);
        $nav =  Db::name('nav')->where('n_isshow', 1)->select();

        // $con = $this->fetch();
        // pre($con);

        $data = [
            'nav' => $nav,
            'nid' => $nid,
        ];

        $this->assign($data);
    }
}
