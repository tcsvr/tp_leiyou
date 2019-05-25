<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function pre($con){
    echo '<pre>';
    print_r($con);
    echo '</pre>';
    exit;
}

//封装一个php弹窗
function alert($con, $url = '')
{
    echo "<script>";
    if ($url) {
        //有url地址跳转到url地址
        echo "alert('{$con}');window.location.href='{$url}';";
    } else {
        //没有url地址，跳转到上一页历史
        echo "alert('{$con}');window.history.go(-1);";
    }
    echo "</script>";
    exit;
}


/**
 * 动态图片路径 放的
 *
 */
function get_upload_path($path = "")
{
    $path = $path . "uploads/";
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    return $path;
}
/**
 * 生成缩略图   用法
 * <img style="max-width:100px" src="/{:thumb(get_upload_path().$v["b_img"])}">
 */
function thumb($path, $w = 200, $h = 200)
{
    if (file_exists($path)) {
        $imgArr = pathinfo($path);
        $image = \think\Image::open($path);
        $thumbname = $imgArr["dirname"] . "/" . $imgArr["filename"] . "_thumb_" . $w . "_" . $h . "." . $imgArr["extension"];
        if (!file_exists($thumbname)) {
            $image->thumb(150, 150, \think\Image::THUMB_CENTER)->save($thumbname);
        }
        if (file_exists($thumbname)) {
            return $thumbname;
        }
    }
    return $path;
}


/**
 * 删除图片
 * 宽,高
 */
function delImg($img, $imgArr = array(
    array(200, 200),
    array(268, 135),
))
{
    if (file_exists(get_upload_path() . $img) && !is_dir(get_upload_path() . $img) && $img) {
        $img = get_upload_path() . $img;
        unlink($img);
        foreach ($imgArr as $v) {
            $config['thumb_marker']   = "_thumb_" . $v[0] . "_" . $v[1];
            $info = pathinfo($img);

            $filename = $info["dirname"] . "/" . $info["filename"] . $config['thumb_marker'] . "." . $info["extension"];
            if (file_exists($filename) && !is_dir($filename) && $filename) {
                unlink($filename);
            }
        }
    } else if (file_exists($img) && !is_dir($img)) {
        unlink($img);
    }
}
