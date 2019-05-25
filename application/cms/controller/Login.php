<?php
namespace app\cms\controller;
use think\Controller;
use think\facade\Request;
use think\Db;

class Login extends Controller{

    // 是否批量验证
    protected $batchValidate = true;

    public function index()
    {
        if(Request::isPost()){
            /*pre(input('post.'));
            $validate = new \app\cms\validate\Admin;
            if (!$validate->check(input('post.'))) {
                pre($validate->getError());
            } */
            $result = $this->validate(input('post.'),'app\cms\validate\Admin');

            if (true !== $result) {
                // 验证失败 输出错误信息
                $this->assign(['result'=>$result]);
                return view('login/login');
            }else{
                //验证成功
                //获取数据
                $username = trim(input('post.username'));
                $password = md5(input('post.password'));
                $status = Db::name('admin')->where('admin_username',$username)->find();
                if($status){
                    $verify = $status['verify'];
                    $repass = $status['admin_password'];
                    $password = md5($password.$verify);
                    if($password == $repass){
                        // echo '登陆成功';
                        session('islog','1');
                        session('username',$username);
                        $adminid = $status['admin_id'];
                        session('adminid',$adminid);
                        //更新系统信息
                        $ip = Request()->server()['REMOTE_ADDR'];
                        $time = time();
                        $data = [
                            'lastip'=>$ip,
                            'lasttime'=>$time,
                        ];
                        $s = Db::name('admin')->where('admin_id',$adminid)->update($data);
                        //$this->assign();
                        $this->success('登陆成功','cms/index/index','',0);

                    }else{
                        echo '密码错误';
                    }

                }else{
                    $this->error('用户名不存在！');
                }
            }
        }else{
            return view('login/login');
        }
    }
    public function out(){
        // return 'exit';
        session('islog',null);
        $this->success('已退出','cms/login/index','',0);
    }




}











?>