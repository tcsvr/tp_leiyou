<?php
namespace app\cms\controller;
use think\Db;
use think\facade\Request;

class Admin extends Common{
    public function index(){
        $admin =  Db::name('admin')->select();

        // $con = $this->fetch();
        // pre($con);

        $data = [
            'admin' => $admin,
        ];

        $this->assign($data);

        if(Request::isPost()){

            $adminarr = input('post.adminarr');
            // pre($adminarr);
            $st = Db::table('admin')->delete($adminarr);
            if($st){

                $this->success('删除成功','','',0);
            }else{
                
                $this->error('删除失败','','',0);
            }
        }

        return view('admin_list');
    }







    protected $batchValidate = true;

    public function add(){

    if(Request::isPost()){
            $result = $this->validate(input('post.'), 'app\cms\validate\Admin');
            // pre($result);

            if (true !== $result) {
                // 验证失败 输出错误信息
                $this->assign(['result' => $result]);
                return view('admin_add');

            } else {
                $admin_username = trim(input('post.username'));
                $status = Db::name('admin')->where('admin_username', $admin_username)->find();

                if($status){
                    alert('用户名已存在');
                    //echo '0';//用户名已存在
                }else{

                    $admin_real = !empty(input('post.admin_real'))? input('post.admin_real'):'';
                    $password = input('post.password');
                    $repassword = input('post.repassword');
                    if($password!==$repassword){
                        alert('密码不一致');
                        //echo '1';//密码不一致
                    }else{

                        $verify = md5(rand(10000, 99999));
                        $password = md5($password.$verify);

                        $data = [ 'admin_username' => $admin_username,
                                'admin_real' => $admin_real,
                                'admin_password' => $password,
                                'verify' => $verify,
                                ];

                        Db::name('admin')->insert($data);

                        $this->success('添加成功','cms/admin/index','',0);
                    }
                }
            }
        }else{
            return view('admin_add');
        }

    }






    public function edit(){
        $aid = Request::param('aid');
        $admin =  Db::name('admin')->where('admin_id', $aid)->find();
        $verify = $admin['verify'];
        $pass = $admin['admin_password'];

        if(Request::isPost()){
            $admin_real = !empty(input('post.admin_real')) ? input('post.admin_real') : '';
            $password = input('post.password');
            $password = md5($password . $verify);
            if($pass!==$password){
                alert('原密码不正确');
            }else{

                $repassword = input('post.repassword');
                $newpassword = input('post.newpassword');
                if ($newpassword !== $repassword) {
                    alert('密码不一致');
                    //echo '1';//密码不一致
                    } else {

                    $newpassword = md5($newpassword . $verify);

                    $sta = Db::name('admin')
                        ->where('admin_id', $aid)
                        ->data([
                            'admin_real' => $admin_real,
                            'admin_password' => $newpassword,
                            ])
                        ->update();
                    if($sta){
                        $this->success('修改成功', 'cms/admin/index', '', 0);
                    }else{
                        $this->error('修改失败', '', '', 0);
                    }
                }
            }
        }else{

            $data = [
                'admin' => $admin,
                'aid' => $aid,
            ];
            $this->assign($data);
            return view('admin_edit');
        }
    }






    public function del(){
        $aid = Request::param('aid');
        $sta = Db::table('admin')->delete($aid);
        // pre($sta);
        if($sta){

            $this->success('删除成功', 'cms/admin/index', '', 0);
        }else{
            $this->error('删除失败', 'cms/admin/index', '', 0);

        }

    }



}
