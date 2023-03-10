<?php


namespace Linnzh;


/**
 * Class NTreeNode N叉树
 *
 *
 * @author  linnzh
 * @created 2023/3/10 13:55
 */
class NTreeNode
{
    /**
     * @var mixed 节点存储值
     */
    public mixed $value;

    /**
     * @var NTreeNode[]|null N叉树子节点
     */
    public ?array $children;

    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->children = [];
    }

    /**
     * 遍历 - 前序遍历 - DFS - 深度优先
     *
     * @param \Linnzh\NTreeNode $root
     * @param array             $result
     *
     * @return array
     *
     * @author  linnzh
     * @created 2023/3/10 15:41
     */
    public function traverse(NTreeNode $root, array &$result = []): array
    {
        $result[] = $root->value;

        foreach ($root->children as $child) {
            $this->traverse($child, $result);
        }

        return $result;
    }

    /**
     * 前序遍历：指先访问根，然后访问子树的遍历方式
     *
     * @param NTreeNode $root
     * @param array     $result
     *
     * @return array
     */
    public function preorderTraverse(NTreeNode $root, array &$result = []): array
    {
        $result[] = $root->value;

        foreach ($root->children as $child) {
            $this->preorderTraverse($child, $result);
        }

        return $result;
    }

    /**
     * 后序遍历：指先访问子树，然后访问根的遍历方式
     *
     * @param NTreeNode $root
     * @param array     $result
     *
     * @return array
     */
    public function postorderTraverse(NTreeNode $root, array &$result = []): array
    {
        foreach ($root->children as $child) {
            $this->postorderTraverse($child, $result);
        }
        $result[] = $root->value;

        return $result;
    }

    // todo 获取叶子结点的数量
    // todo 获取树的最大深度/层数
    // todo 获取最长路径（直径）
    // todo 根据一个前序遍历的数组，输出一棵树（Tree 型结构）
    // todo 获取两个节点之间的路径
    // todo 计算路径总和
    // todo 查找最大/最小值
    // todo 查找第 N 大的值
    // todo 查找众数（出现次数最多的值）
    // todo 删除给定值的叶子结点（删除子树）
    // todo 搜索符合路径和等于指定值的所有路径（限制：自上而下）
    // todo 插入「一层」结点 https://leetcode.cn/problems/add-one-row-to-tree/?show=1
    // todo 计算「范围和」：返回值位于范围 [low, high] 之间的所有结点的值的和


    /**
     * 获取一棵 N 叉树的全部路径（DFS，自顶而下）
     *
     * @param \Linnzh\NTreeNode $root
     * @param array             $paths
     * @param array             $path
     *
     * @author  linnzh
     * @created 2023/3/10 13:57
     */
    public function paths(NTreeNode $root, array &$paths = [], array $path = [])
    {
        if (!is_null($root)) {
            $path[] = $root->value;
        }

        if (empty($root->children)) {
            $paths[] = $path;
            return;
        }

        foreach ($root->children as $k => $child) {
            $this->paths($child, $paths, $path);
        }
    }


    /**
     * 查找路径
     *
     * @param \Linnzh\NTreeNode $root
     * @param mixed             $value
     * @param array             $path
     *
     * @return array
     * @author  linnzh
     * @created 2023/3/10 15:49
     */
    public function findPath(NTreeNode $root, mixed $value, array &$path = [])
    {
        if (!is_null($root)) {
            $path[] = $root->value;
        }

        if (empty($root->children)) {
            return $path;
        }

        foreach ($root->children as $k => $child) {
            $curPath = $path;
            $curPath = $this->findPath($child, $value, $curPath);

            if (!empty($curPath) && end($curPath) == $value) {
                $path = $curPath;
                break;
            }
        }

        return $path;
    }
}