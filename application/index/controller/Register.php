<?php
namespace app\index\controller;

use think\Db;
// use think\facade\Request;

class Register extends Common
{
    public function register(){
        // $banner =  Db::name('banner')->where('b_isshow', 1)->select();
        // $product =  Db::name('product')->select();
        // $server =  Db::name('server')->select();
        // // $con = $this->fetch();
        // // pre($banner);
        // $data = [
        //     'banner' => $banner,
        //     'product' => $product,
        //     'server' => $server,
        // ];
        // $this->assign($data);
        return view( '');
    }
    public function zhuche(){

        $username = input( 'post.username');
        $stac =  Db::name('user')->where('u_name',$username)->find();
        pre($stac);exit;
        if(!empty($stac)){
            return 1;
        }

    }





}
/*
if($_POST){

if(!isset($_COOKIE['username']) || empty($_COOKIE['username']) || isset($_COOKIE['pass']) || empty($_COOKIE['pass'])
|| isset($_COOKIE['password']) || empty($_COOKIE['password'])){
    alert('填写内容不正确');
    // echo '填写内容不正确';exit;
}
$u_namme = $_COOKIE['username'];
$password = md5($_COOKIE['pass']);
// pre($u_namme);



$sql = $mysql->sql = "INSERT INTO tv_user (`u_name`,`u_password`) VALUES ('{$u_namme}','{$password}')";
$bool = mysql_query($sql);
if (!$bool && mysql_affected_rows()) {
    echo '注册失败';
    exit;
} else {

    $mysql->sql = "SELECT * FROM tv_user WHERE u_name = '{$u_namme}'";
    $userinfo = $mysql->getOne();
    // pre($userinfo);

    setcookie('islog', '1');
    // 存用户名
    setcookie('username', $userinfo['u_name']);
    // 存用户ID
    setcookie('uid', $userinfo['u_id']);

    header('Location:user_info.php');
}


}

*/









?>