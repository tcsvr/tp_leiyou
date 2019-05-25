<?php
namespace app\index\controller;
use think\Db;

class News extends Common{

    public function index(){
        $news =  Db::name('news')
                ->order('n_id','desc')
                ->paginate(2);
        // pre($product);

        $page = $news->render();
        $data = [
            'news' => $news,
            'page' => $page,
        ];
        $this->assign($data);
        return view('news');
    }

}

?>