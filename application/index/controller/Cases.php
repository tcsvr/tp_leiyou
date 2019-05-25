<?php
namespace app\index\controller;
use think\Db;

class Cases extends Common{
    public function index()
    {

        $cases =  Db::name('cases')
                ->order('c_id', 'desc')
                ->paginate(3);

        $page = $cases->render();

        $data = [
            'cases' => $cases,
            'page' => $page,
        ];

        $this->assign($data);
        return view( 'cases');

    }

}

?>