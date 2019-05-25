<?php
namespace app\cms\controller;

use think\Db;
use think\facade\Request;
// use app\index\controller\Common;

class product extends Common
{
    public function index()
    {
        $product = Db::name('product')->select();
        $this->assign(['product' => $product,]);

        if (Request::isPost()) {

            $productarr = input('post.productarr');

            Db::table('product')->delete($productarr);

            $this->success('删除成功', '', '', 0);
        }

        return view('product_list');
    }





    public function add()
    {
        if ($_POST) {
            if (!isset($_FILES['upload']['']['name']) || empty($_FILES['upload']['']['name'])) {
                alert('请上传文件');
            }
        }


        if (Request::isPost()) {
            $p_p1 = input('post.p_p1');
            $p_p2 = input('post.p_p2');
            $p_txt = input('post.p_txt');

            //echo '已提交'; 开始文件上传
            //获取表单上传文件 例如上传了001.jpg
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
                $p_img = $path . $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getFilename();
                $data = [
                    'p_p1' => $p_p1,
                    'p_p2' => $p_p2,
                    'p_txt' => $p_txt,
                    'p_img' => $p_img,
                ];
                Db::name('product')->insert($data);

                $this->success('添加成功', 'cms/product/index', '', 0);
            } else {
                // 上传失败获取错误信息
                $err = $file->getError();
                alert($err);
            }
        } else {
            return view('product_add');
        }
    }






    public function edit()
    {
        $bid = Request::param('bid');

        if (Request::isPost()) {
            if (!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])) {


                $p_p1 = input('post.p_p1');
                $p_txt = input('post.p_txt');
                $p_isshow = input('post.p_isshow');
                $sta = Db::name('product')
                    ->where('p_id', $bid)
                    ->data([
                        'p_p1' => $p_p1,
                        'p_txt' => $p_txt,
                        'p_isshow' => $p_isshow,
                    ])
                    ->update();
                if ($sta) {
                    $this->success('添加成功', 'cms/product/index', '', 0);
                } else {
                    $this->error('添加失败', '', '', 0);
                }
            } else {
                $p_p1 = input('post.p_p1');
                $p_txt = input('post.p_txt');
                $p_isshow = input('post.p_isshow');

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
                    $p_img = $path . $info->getSaveName();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
                    //echo $info->getFilename();
                }

                $sta = Db::name('product')
                    ->where('p_id', $bid)
                    ->data([
                        'p_p1' => $p_p1,
                        'p_txt' => $p_txt,
                        'p_img' => $p_img,
                        'p_isshow' => $p_isshow,
                    ])
                    ->update();
                if ($sta) {
                    $this->success('添加成功', 'cms/product/index', '', 0);
                } else {
                    $this->error('添加失败', '', '', 0);
                }
            }
        } else {

            $product =  Db::name('product')->where('p_id', $bid)->find();
            $data = [
                'product' => $product,
                'bid' => $bid,
            ];
            $this->assign($data);
            return view('product_edit');
        }
    }






    public function del()
    {
        $bid = Request::param('bid');
        $sta = Db::table('product')->delete($bid);
        // pre($sta);
        if ($sta) {

            $this->success('删除成功', 'cms/product/index', '', 0);
        } else {
            $this->error('删除失败', 'cms/product/index', '', 0);
        }
    }
}
