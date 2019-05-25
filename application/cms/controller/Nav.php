<?php
namespace app\cms\controller;

use think\Db;
use think\facade\Request;

class Nav extends Common{
    public function index(){
        $nid = Request::param('nid', 1);
        $nav =  Db::name('nav')->select();

        // $con = $this->fetch();
        // pre($con);

        $data = [
            'nav' => $nav,
            'nid' => $nid,
        ];

        $this->assign($data);

        if(Request::isPost()){

            $navarr = input('post.navarr');

            $st = Db::table('nav')->delete($navarr);
            if($st){
                $this->success('删除成功','','',0);

            }else{
                $this->error()('删除失败','','',0);

            }

        }

        return view('nav_list');
    }







    public function add(){
        if(Request::isPost()){
            $n_title = input('post.n_title');
            $n_link = input('post.n_link');
            $n_isshow = input('post.n_isshow');
            $data = ['n_title' => $n_title,
                     'n_link' => $n_link,
                     'n_isshow' => $n_isshow,
                    ];
            Db::name('nav')->insert($data);

            $this->success('添加成功','cms/nav/index','',0);
        }else{
            return view('nav_add');
        }
    }






    public function edit(){
        $nid = Request::param('nid');

        if(Request::isPost()){
            $n_title = input('post.n_title');
            $n_link = input('post.n_link');
            $n_isshow = input('post.n_isshow');
            $sta = Db::name('nav')
                ->where('n_id', $nid)
                ->data([
                    'n_title' => $n_title,
                    'n_link' => $n_link,
                    'n_isshow' => $n_isshow,
                    ])
                ->update();
            if($sta){
                $this->success('添加成功', 'cms/nav/index', '', 0);
            }else{
                $this->error('添加失败', '', '', 0);
            }


        }else{

            $nav =  Db::name('nav')->where('n_isshow', 1)->where('n_id', $nid)->find();
            $data = [
                'nav' => $nav,
                'nid' => $nid,
            ];
            $this->assign($data);
            return view('nav_edit');
        }
    }






    public function del(){
        $nid = Request::param('nid');
        $sta = Db::table('nav')->delete($nid);
        // pre($sta);
        if($sta){

            $this->success('删除成功', 'cms/nav/index', '', 0);
        }else{
            $this->error('删除失败', 'cms/nav/index', '', 0);

        }

    }



}


?>