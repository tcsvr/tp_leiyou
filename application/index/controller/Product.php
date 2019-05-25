<?php
namespace app\index\controller;
use think\Db;
class Product  extends Common
{
    public function index()
    {

        $product =  Db::name('product')->select();
        // pre($product);
        $data = [
            'product' => $product,
        ];

        $this->assign($data);

        return view('product');
    }

}
?>