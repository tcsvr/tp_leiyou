<?php
namespace app\cms\controller;
use think\Db;

// use app\index\controller\Common;

class Index extends Common
{
    public function index(){
        $adminid = session('adminid');
        // $admin = Db::name('admin')->where('admin_id', $adminid)->find();

        $version = Db::query('SELECT VERSION() AS ver');
        $admin = Db::name("admin")->where("admin_id", $adminid)->find();
        $userArr["OS"] = PHP_OS;
        $userArr["PV"] = PHP_VERSION;
        $userArr["MV"] = $version[0]['ver'];
        // pre($userArr);

        $data = [
            'admin' => $admin,
            'userArr' => $userArr,
        ];

        $this->assign($data);

        // echo '123';
        // pre( session('islog'));
        return view();
    }


}
