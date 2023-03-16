<?php
/**
 * Author: PFinal南丞
 * Date: 2023/3/10
 * Email: <lampxiezi@163.com>
 */


/**
 * 定义一个节点类
 */
class Node
{
    public null|self $left;
    public null|self $right;

    public function __construct(public $value)
    {
        $this->value = $value;
        $this->left  = null;
        $this->right = null;
    }
}

/**
 * 创建一个二叉树
 * @param $depth
 * @return Node|null
 */
function createRandomBinaryTree($depth): Node|null
{
    if ($depth == 0) {
        return null;
    }
    $node        = new Node(rand(1, 100));
    $node->left  = createRandomBinaryTree($depth - 1);
    $node->right = createRandomBinaryTree($depth - 1);
    return $node;
}

/**
 * 获取二叉树的深度与时间度
 * @param $node
 * @param $depth
 * @param $depths
 * @return void
 */
function traverseBinaryTreeDFS($node, $depth, &$depths): void
{
    if ($node == null) {
        return;
    }
    $depths[] = $depth;
    traverseBinaryTreeDFS($node->left, $depth + 1, $depths);
    traverseBinaryTreeDFS($node->right, $depth + 1, $depths);
}

// 使用
$tree   = createRandomBinaryTree(3);
$depths = array();
traverseBinaryTreeDFS($tree, 0, $depths);
print_r($depths);
