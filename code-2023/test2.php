<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/7
 * Email: <lampxiezi@163.com>
 */

$goods_ids = [1, 3, 4, 7];
// sql 语句
$sql = "select c.coupon_id,c.type,coupon_goods.goods_id from coupon_goods left join coupon c on coupon_goods.coupon_id = c.coupon_id
where coupon_goods.goods_id in (" . implode(',', $goods_ids) . ")";

// 执行结果:
$result = [
    [
        'coupon_id' => 2,
        'type'      => 2,
        'goods_id'  => 1
    ],
    [
        'coupon_id' => 3,
        'type'      => 3,
        'goods_id'  => 3
    ]
];

// 可用优惠券
$coupons = [];
foreach ($result as $item) {
    switch ($item['type']) {
        case 1:
            $temp = [];
            foreach ($goods_ids as $v) {
                $temp[] = ['goods_id' => $v, 'coupon_id' => $item['coupon_id'], 'coupon_status' => 1];
            }
            $coupons[] = $temp;
            break;
        case 2:
            $temp = [];
            foreach ($goods_ids as $v) {
                $status = 1;
                $temp[] = ['goods_id' => $v, 'coupon_id' => $item['coupon_id'], 'coupon_status' => ($v == $item['goods_id'] ? 1 : 0)];
            }
            $coupons[] = $temp;
            break;
        case 3:
            $temp = [];
            foreach ($goods_ids as $v) {
                $status = 1;
                $temp[] = ['goods_id' => $v, 'coupon_id' => $item['coupon_id'], 'coupon_status' => ($v == $item['goods_id'] ? 0 : 1)];
            }
            $coupons[] = $temp;
            break;
    }
}
var_dump($coupons);


