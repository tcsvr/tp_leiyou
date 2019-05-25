<?php
namespace app\cms\controller;
use think\Db;
use think\facade\Request;

// use app\index\controller\Common;

class User extends Common
{
    public function index(){
        $user =  Db::name('user')->order('lasttime','asc') ->select();
        $data = [
            'user' =>$user,
        ];
        // pre($data);
        $this->assign($data);

        if (Request::isPost()) {

            $idarr = input('post.idarr');

            $sta = Db::table('user')->delete($idarr);
            if($sta){
                $this->success('删除成功', 'cms/user/index', '', 0);

            }else{
                $this->error('删除失败', 'cms/user/index', '', 0);

            }
        }

        return view('user_list');
    }


    public function del (){
        $uid = Request::param('uid');
        $sta = Db::table('user')->delete($uid);
        // pre($sta);
        if ($sta) {
            $this->success('删除成功', 'cms/user/index', '', 0);
        } else {
            $this->error('删除失败', 'cms/user/index', '', 0);
        }
    }


}


?>