<?php
/**
 * 二位数组取最大值或者最小值
 * @param array $arr
 * @param string $field
 * @param string $type
 * @return mixed
 */
function getArrayMinOrMax(array $arr, string $field, string $type = 'min'): mixed
{
    $temp = [];
    foreach ($arr as $k => $v) {
        $temp[] = $v[$field];
    }
    return $type == 'min' ? min($temp) : max($temp);
}


/**
 * 按照指定数量分块
 * @param $data
 * @param int $num
 * @return array
 */
function arraySplit(array $data, int $num = 5): array
{
    $arrRet = [];
    if (!isset($data) || empty($data)) {
        return $arrRet;
    }
    $iCount = count($data) / $num;
    if (!is_int($iCount)) {
        $iCount = ceil($iCount);
    } else {
        $iCount += 1;
    }
    for ($i = 0; $i < $iCount; ++$i) {
        $arrInfos = array_slice($data, $i * $num, $num);
        if (empty($arrInfos)) {
            continue;
        }
        $arrRet[] = $arrInfos;
        unset($arrInfos);
    }
    return $arrRet;
}


//二维数组，指定字段，取最大值
function searchmax($arr, $field) // 最小值 只需要最后一个max函数  替换为 min函数即可
{
    if (!is_array($arr) || !$field) { //判断是否是数组以及传过来的字段是否是空
        return false;
    }

    $temp = array();
    foreach ($arr as $key => $val) {
        $temp[] = $val[$field]; // 用一个空数组来承接字段
    }
    return max($temp);  // 用php自带函数 max 来返回该数组的最大值，一维数组可直接用max函数

}
