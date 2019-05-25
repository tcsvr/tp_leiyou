<?php
namespace app\cms\controller;

// use app\index\controller\Common;

class Article extends Common
{
    public function index()
    {
        // echo '123';
        // pre( session('islog'));
        return view( 'article/article_list');
    }

    public function add(){

        return view('article/article_add');
    }
    public function edid(){

        return view('article/article_edit');
    }
    public function del(){

       

    }


}
