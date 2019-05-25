<?php
namespace app\index\controller;
use think\Db;
// use think\facade\Request;

class Index extends Common{
    public function index()
    {
        $banner =  Db::name('banner')->where('b_isshow', 1)->select();
        $product =  Db::name('product')->select();
        $server =  Db::name('server')->select();

        // $con = $this->fetch();
        // pre($banner);

        $data = [
            'banner' => $banner,
            'product' => $product,
            'server' => $server,
        ];

        $this->assign($data);

        return view();
    }

    public function isuser(){



        // $username = !empty(input('post.username'))?trim(input('post.username')):"null";
        // $password = !empty(input('post.password'))?input('post.password'):"null";

        $username = trim(input('post.username'));
        $password = md5(input('post.password'));

        $sta =  Db::name('user')->where('u_name', $username)->where('u_password', $password)->find();
        // pre($sta);
        if (!empty($sta)) {
            // 登录成功
            // 存登录状态
            session('islog', '1');
            // 存用户名
            session('username', $sta['u_name']);
            // 存ID
            session('uid', $sta['u_id']);
            echo 1;
            // return view('index/index/index');
        } else {
            // 登录失败
            echo 0;
        }

    }

    public function out(){
        // return '退出';
        session('islog', null);
        $this->success('已退出', 'index/index/index','',0);
    }



}
