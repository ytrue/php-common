<?php

use JetBrains\PhpStorm\Pure;

/**
 * 获得文件类型
 * @param string $file
 * @return false|string
 */
#[Pure]
function getFileType(string $file): bool|string
{
    return substr(strrchr($file, '.'), 1);
}

/**
 * 判断是否是图片
 * @param string $fileType
 * @return bool
 */
#[Pure]
function isImage(string $fileType): bool
{
    $arr = [
        'png',
        'jpg',
        'jpeg',
        'bmp',
        'gif',
        'webp',
        'psd',
        'svg',
        'tiff'
    ];
    return in_array($fileType, $arr);
}

/**
 * 递归删除目录
 * @param string $path
 * @return bool
 */
function delDir(string $path): bool
{
    //如果是目录则继续
    if (is_dir($path)) {
        //扫描一个文件夹内的所有文件夹和文件并返回数组
        $p = scandir($path);
        //如果 $p 中有两个以上的元素则说明当前 $path 不为空
        if (count($p) > 2) {
            foreach ($p as $val) {
                //排除目录中的.和..
                if ($val != "." && $val != "..") {
                    //如果是目录则递归子目录，继续操作
                    if (is_dir($path . $val)) {
                        //子目录中操作删除文件夹和文件
                        delDir($path . $val . '/');
                    } else {
                        //如果是文件直接删除
                        unlink($path . $val);
                    }
                }
            }
        }
    }
    //删除目录
    return rmdir($path);
}
