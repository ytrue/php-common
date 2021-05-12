<?php

/**
 * 将时间戳转换为日期时间
 * @param int $time
 * @param string $format
 * @return string
 */
function dateTime(int $time, string $format = 'Y-m-d H:i:s'): string
{
    $time = is_numeric($time) ? $time : strtotime($time);
    return date($format, $time);
}

/**
 * 时间转化
 * @param $findData
 * @return array
 */
function timeConversion(array $findData): array
{
    $arrKey = array_keys($findData);
    foreach ($arrKey as $key => $value) {
        if (substr($value, -5) == '_time') {
            if (!empty($findData[$value])) {
                $findData[$value] = dateTime($findData[$value]);
            }
        }
    }
    return $findData;
}

/**
 * 列表时间转换
 * @param $list
 * @return array
 */
function timeListConversion(array $list): array
{
    foreach ($list as $k => $v) {
        $list[$k] = timeConversion($v);
    }
    return $list;
}
