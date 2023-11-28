<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/7
 * Email: <lampxiezi@163.com>
 */

//$arr = [
//    'goods_id'   => 1,
//    'goods_name' => '测试商品',
//    'goods_sku'  => [
//        ['sku_id' => 2, 'sku_name' => '规格2'],
//        ['sku_id' => 3, 'sku_name' => '规格3'],
//        ['sku_id' => null, 'sku_name' => '规格4'],
//    ]
//];
//
//$sku_ids = array_filter(array_column($arr['goods_sku'], 'sku_id'));
//
//// 构造删除 sql 语句 伪代码
//$sql = "delete from goods_sku where sku_id not in (" . implode(",", $sku_ids) . ") and goods_id=" . $arr['goods_id'];
//echo $sql;
//
//// 构造修改语句
//$up_sql = "replace into goods_sku(sku_id,sku_name,goods_id)values";
//foreach ($arr["goods_sku"] as $item) {
//    $up_sql .= '(' . $item['sku_id'] . ',\'' . $item['sku_name'] . '\',' . $arr['goods_id'] . '),';
//}
//echo $up_sql;
$a = true;
if($a) {
    echo "true";
}else label: {
    echo "false";
}

