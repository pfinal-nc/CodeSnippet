<?php

/**
 * @author pfinal南丞
 * @date 2021年07月09日 下午1:52
 */
class TreeNode
{
    public $val;
    public $left = NULL;
    public $right = NULL;

    function __construct($val)
    {
        $this->val = $val;
    }
}


//function reConstructBinaryTree($pre, $vin)
//{
//    if ($pre && $vin) {
//        $root        = new TreeNode($pre[0]);
//        $index       = array_search($pre[0], $vin); // 根节点在中序数组的位置
//        $root->left  = reConstructBinaryTree(array_slice($pre, 1, $index), array_slice($vin, 0, $index));
//        $root->right = reConstructBinaryTree(array_slice($pre, $index + 1), array_slice($vin, $index + 1));
//        return $root;
//    }
//    return null;
//}
//
//$arr = [1, 2, 4, 7, 3, 5, 6, 8];
//var_export(reConstructBinaryTree($arr, [3]));


/**
 *  判断是否为二叉树
 */
//function HasSubtree($pRoot1, $pRoot2)
//{
//    return (!is_null($pRoot1)) && (!is_null($pRoot2))
//        && (isSubtree($pRoot1, $pRoot2)   // 是否有左节点
//            || HasSubtree($pRoot1->left, $pRoot2) //是否有左节点
//            || HasSubtree($pRoot1->right, $pRoot2) // 是否有右节点
//        );
//}
//
//function isSubtree($pRoot1, $pRoot2)
//{
//    if (is_null($pRoot2)) return true; // B 树的子节点递归完时,返回true
//    if (is_null($pRoot1)) return false; // B 树节点不为空 但A 树节点为空, 直接返回 false 与上句代码顺序不可调换
//
//    return $pRoot1->val == $pRoot2->val  // 判断节点值是否相等
//        && isSubtree($pRoot1->left, $pRoot2->left) // 递归左节点
//        && isSubtree($pRoot1->right, $pRoot2->right); // 递归右节点
//
//}

# 镜像二叉树

function Mirror(&$root)
{
    if (is_null($root)) return false;
    $left = $right = null; // 实现节点交换的零时变量
    if ($root->left) $left = Mirror($root->left); // 如果当前节点有左节点, 则递归
    if ($root->right) $right = Mirror($root->right); // 如果当前节点有右节点,则递归

    $root->left  = $right;  // 交换当前节点的左右节点
    $root->right = $left;
    return $root;


}