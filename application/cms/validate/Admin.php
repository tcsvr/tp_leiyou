<?php
namespace app\cms\validate;
use think\Validate;

class Admin extends Validate{
    protected $rule = [
        'username'  =>  'require|length:4,18|alphaDash',
        'password'  =>  'require',
    ];
    protected $message  =   [
        'username.require' => '用户名必须填写',
        'username.between'     => '用户名为4-18个字符',
        'username.alphaDash'     => '必须为、英文、数字、下划线',
        'password.require' => '密码必须填写',
        // 'age.between'  => '年龄只能在1-120之间',
        // 'email'        => '邮箱格式错误',
    ];

}

















?>