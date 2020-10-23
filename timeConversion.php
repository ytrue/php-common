<?php

/**
 * 将时间戳转换为日期时间
 * @param int $time 时间戳
 * @param string $format 日期时间格式
 * @return string
 */
function datetime($time, $format = 'Y-m-d H:i:s')
{
    $time = is_numeric($time) ? $time : strtotime($time);
    return date($format, $time);
}

/**
 * 时间转化
 * @param $findData
 * @return mixed
 */
function timeConversion(array $findData)
{
    $arrKey = array_keys($findData);
    foreach ($arrKey as $key => $value) {
        if (substr($value, -5) == '_time') {
            if (!empty($findData[$value])) {
                $findData[$value] = datetime($findData[$value]);
            }
        }
    }
    return $findData;
}

/**
 * 列表时间转换
 * @param $list
 * @return mixed
 */
function timeListConversion(array $list)
{
    foreach ($list as $k => $v) {
        $list[$k] = timeConversion($v);
    }
    return $list;
}
