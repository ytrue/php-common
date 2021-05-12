<?php

/**
 * 传值引用获得树（这个比递归好）
 * @param array $data
 * @return array
 */
function generateTree(array $data): array
{
    $items = array();
    foreach ($data as $v) {
        $items[$v['id']] = $v;
    }
    $tree = array();
    foreach ($items as $k => $item) {
        if (isset($items[$item['pid']])) {
            $items[$item['pid']]['children'][] = &$items[$k];
        } else {
            $tree[] = &$items[$k];
        }
    }
    return $tree;
}
