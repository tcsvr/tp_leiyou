<?php
namespace app\cms\controller;

// use app\index\controller\Common;

class Ajax extends Common
{
    public function index()
    {
        // echo '123';
        // pre( session('islog'));
        return view();
    }
    public function isuser()
    {
        // echo '123';
        // pre( session('islog'));
        pre(input('get.'));
        return view();
    }
}


?>