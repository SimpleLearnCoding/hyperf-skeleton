<?php


namespace Cases;


use PHPUnit\Framework\TestCase;

/**
 * Class AlgoTest
 *
 * @author  linnzh
 * @created 2023/3/10 09:18
 */
class AlgoTest extends TestCase
{
    public function testExample()
    {
        // 这是一个tree，需要输入一个id，返回该节点回溯到根目录的路径，例如：输入（3），输出（[1,2,3]）。输入（7），输出（[6,7]）
        $tree = json_decode('[{"id":1,"name":"颜色","children":[{"id":2,"name":"红色","children":[{"id":3,"name":"淡红色","children":[]},{"id":4,"name":"深红色","children":[]},{"id":5,"name":"洋红色","children":[]}]}]},{"id":6,"name":"尺寸","children":[{"id":7,"name":"小","children":[]},{"id":8,"name":"中","children":[]},{"id":9,"name":"大","children":[]}]},{"id":10,"name":"人群","children":[{"id":11,"name":"工人","children":[]},{"id":12,"name":"白领","children":[{"id":13,"name":"程序员","children":[{"id":14,"name":"测试","children":[]}]}]}]}]', true);

        if (!isset($tree['id'], $tree['children'])) {
            $tree = ['id' => null, 'children' => $tree];
        }

        $path = $paths = [];
        $this->dfs($tree, $paths, $path);
        $this->assertCount(8, $paths);

        $this->assertEquals('1', implode(',', $this->main($tree, 1)));
        $this->assertEquals('1,2', implode(',', $this->main($tree, 2)));
        $this->assertEquals('1,2,3', implode(',', $this->main($tree, 3)));
        $this->assertEquals('1,2,4', implode(',', $this->main($tree, 4)));
        $this->assertEquals('1,2,5', implode(',', $this->main($tree, 5)));
        $this->assertEquals('6', implode(',', $this->main($tree, 6)));
        $this->assertEquals('6,7', implode(',', $this->main($tree, 7)));
        $this->assertEquals('6,8', implode(',', $this->main($tree, 8)));
        $this->assertEquals('6,9', implode(',', $this->main($tree, 9)));
        $this->assertEquals('10', implode(',', $this->main($tree, 10)));
        $this->assertEquals('10,11', implode(',', $this->main($tree, 11)));
        $this->assertEquals('10,12', implode(',', $this->main($tree, 12)));
        $this->assertEquals('10,12,13', implode(',', $this->main($tree, 13)));
        $this->assertEquals('10,12,13,14', implode(',', $this->main($tree, 14)));

    }

    /**
     * 获取一颗 N 叉树的全部路径（自顶而下）
     *
     * @param array $tree
     * @param array $paths
     * @param array $path
     *
     * @author  linnzh
     * @created 2023/3/10 13:57
     */
    public function dfs(array $tree, array &$paths = [], array $path = [])
    {
        if (!is_null($tree['id'])) {
            $path[] = $tree['id'];
        }

        if (empty($tree['children'])) {
            $paths[] = $path;
            return;
        }

        foreach ($tree['children'] as $k => $child) {
            $this->dfs($child, $paths, $path);
        }
    }

    /**
     * @param array $tree
     * @param int   $id
     *
     * @return array
     *
     * @author  linnzh
     * @created 2023/3/10 10:06
     */
    public function main(array $tree, int $id): array
    {
        $path = $paths = [];

        $this->findPath($tree, $id, $path);

        return $path;
    }

    public function findPath(array $tree, int $id, array &$path = [])
    {
        if (!is_null($tree['id'])) {
            $path[] = $tree['id'];
        }

        if (empty($tree['children'])) {
            return $path;
        }

        foreach ($tree['children'] as $k => $child) {

            $curPath = $path;
            $curPath = $this->findPath($child, $id, $curPath);

            if (!empty($curPath) && end($curPath) == $id) {
                $path = $curPath;
                break;
            }
        }

        return $path;
    }
}