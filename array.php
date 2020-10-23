<?php
/*
 * 二位数组取最大值或者最小值
 */
function getArrayMinOrMax($arr, $field, $type = 'min')
{
    $temp = [];
    foreach ($arr as $k => $v) {
        $temp[] = $v[$field];
    }
    return $type == 'min' ? min($temp) : max($temp);
}
