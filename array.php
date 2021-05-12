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
