<?php
namespace app\cms\controller;
use think\Db;
use think\facade\Request;
// use app\index\controller\Common;

class Banner extends Common
{
    public function index()
    {
        $banner = Db::name('banner')->select();
        $this->assign(['banner'=>$banner,]);

        if (Request::isPost()) {

            $bannerarr = input('post.bannerarr');

            Db::table('banner')->delete($bannerarr);

            $this->success('删除成功', '', '', 0);
        }

        return view('banner_list');
    }





    public function add(){
        if($_POST){
            if (!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])) {
                alert('请上传文件');
            }
        }


        if (Request::isPost()) {
            $b_title = input('post.b_title');
            $b_txt = input('post.b_txt');
            $b_isshow = input('post.b_isshow');

            //echo '已提交'; 开始文件上传
            //获取表单上传文件 例如上传了001.jpg
            $file = request()->file('upload');
            // pre($file);
           // if(empty($file)){ alert ('您好，请上传照片'); }
            $path = 'uploads/';
            if(!file_exists( $path)){
                mkdir($path,0777,true);
            }
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file->validate(['size' => 1567800, 'ext' => 'jpg,png,gif,jpeg'])->move( $path);
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 jpg
                //echo $info->getExtension();
                // 输出 uploads/20160820/42a79759f284b767dfcb2a0197904287.jpg
                $b_img = $path.$info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getFilename();
                $data = [
                    'b_title' => $b_title,
                    'b_txt' => $b_txt,
                    'b_img' => $b_img,
                    'b_isshow' => $b_isshow,
                ];
                Db::name('banner')->insert($data);

                $this->success('添加成功', 'cms/banner/index', '', 0);
            } else {
                // 上传失败获取错误信息
                $err = $file->getError();
                alert($err);
            }
        } else {
            return view('banner_add');
        }
    }






    public function edit()
    {
        $bid = Request::param('bid');

        if (Request::isPost()) {
            if (!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])) {


            $b_title = input('post.b_title');
            $b_txt = input('post.b_txt');
            $b_isshow = input('post.b_isshow');
                $sta = Db::name('banner')
                    ->where('b_id', $bid)
                    ->data([
                        'b_title' => $b_title,
                        'b_txt' => $b_txt,
                        'b_isshow' => $b_isshow,
                    ])
                    ->update();
                if ($sta) {
                    $this->success('添加成功', 'cms/banner/index', '', 0);
                } else {
                    $this->error('添加失败', '', '', 0);
                }


            }else{
                $b_title = input('post.b_title');
                $b_txt = input('post.b_txt');
                $b_isshow = input('post.b_isshow');

                $file = request()->file('upload');
                // pre($file);
                // if(empty($file)){ alert ('您好，请上传照片'); }
                $path = 'uploads/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                // 移动到框架应用根目录/uploads/ 目录下
                $info = $file->validate(['size' => 1567800, 'ext' => 'jpg,png,gif,jpeg'])->move($path);
                if ($info) {
                    // 成功上传后 获取上传信息
                    // 输出 jpg
                    //echo $info->getExtension();
                    // 输出 uploads/20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $b_img = $path . $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getFilename();
                }

                $sta = Db::name('banner')
                    ->where('b_id', $bid)
                    ->data([
                        'b_title' => $b_title,
                        'b_txt' => $b_txt,
                        'b_img' => $b_img,
                        'b_isshow' => $b_isshow,
                    ])
                    ->update();
                    if ($sta) {
                        $this->success('添加成功', 'cms/banner/index', '', 0);
                    } else {
                        $this->error('添加失败', '', '', 0);
                    }
            }
        } else {

            $banner =  Db::name('banner')->where('b_id', $bid)->find();
            $data = [
                'banner' => $banner,
                'bid' => $bid,
            ];
            $this->assign($data);
            return view('banner_edit');
        }
    }






    public function del()
    {
        $bid = Request::param('bid');
        $sta = Db::table('banner')->delete($bid);
        // pre($sta);
        if ($sta) {

            $this->success('删除成功', 'cms/banner/index', '', 0);
        } else {
            $this->error('删除失败', 'cms/banner/index', '', 0);
        }
    }
}
