<?php
namespace app\index\controller;
use think\facade\Request;
use think\Db;

class About extends Common
{
    public function index()
    {
        $about =  Db::name('about')->select();
        $aid = Request::param('aid', 1);

        $about_detail =  Db::name('about_detail')->where('ad_id',$aid)->find();
        // pre( $about_detail);
        

        // pre($product);
        $data = [
            'about' => $about,
            'about_detail' => $about_detail,
            'aid' => $aid,
        ];

        $this->assign($data);
        return view('about');
    }

}
?>