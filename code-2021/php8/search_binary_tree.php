<?php
/**
 * @author pfinal南丞
 * @date 2021年07月12日 上午10:43
 */

# 判断序列是否为二叉搜索树遍历的结果

function VerifySquenceOfBST($sequence)
{
    $length = count($sequence); // 序列长度
    if ($length == 0) return false;
    $root = end($sequence);  // 序列的根节点

    // 找到第一个大于根节点的位置, 区分出左 右子树
    for ($i = 0; $i < $length - 1; $i++)
        if ($sequence[$i] > $root) break;

    // 验证右子树是否都大于根节点
    for ($j = $i + １; $j < $length - 1; $j++)
        if ($sequence[$j] < $root) return false;

    $left = $right = true;

    if ($i > 0) { // 有左子树, 递归
        $left = VerifySquenceOfBST(array_slice($sequence, 0, $i));
    }
    if ($j < $length) { // 有右子树，递归
        $right = VerifySquenceOfBST(array_slice($sequence, $i, $length - $i - 1));
    }
    return $left && $right;
}