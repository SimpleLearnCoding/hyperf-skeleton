<?php

function uuid(string $prefix = ''): string
{
    $chars = md5(uniqid((string) mt_rand(), true));
    $uuid = substr($chars, 0, 8) . '-'
        . substr($chars, 8, 4) . '-'
        . substr($chars, 12, 4) . '-'
        . substr($chars, 16, 4) . '-'
        . substr($chars, 20, 12);

    return $prefix . $uuid;
}

/**
 * 生成随机向量 - 二进制
 * 可通过 bin2hex() 函数转换为具备可读性的字符串
 *
 * @param int $length
 *
 * @return string
 *
 * @author  linnzh
 * @created 2023/3/8 16:01
 */
function generateIv(int $length = 16)
{
    if ($length <= 0) {
        throw new InvalidArgumentException('Invalid Argument');
    }
    do {
        $bytes = random_bytes($length);
    } while (!$bytes);

    return $bytes;
}

/**
 * 假设剪刀石头布分别使用 0、1、2 指代
 * 输入双方手势对应的值，计算输赢（-1，输；0，平局；1，胜利）
 *
 * @param int $left
 * @param int $right
 *
 * @return int
 */
function mora(int $left, int $right)
{
    return match (true) {
        ($left == $right) => 0,
        ($right == (($left + 1) % 3)) => -1,
        default => 1,
    };
}

/**
 * 最大公约数：辗转相除法
 *
 * @param int $left
 * @param int $right
 *
 * @return int|mixed
 */
function maxCommonDivisor(int $left, int $right)
{
    if ($left <= 0 || $right <= 0) {
        return null;
    }
    while ($left != $right) {
        if ($left > $right) {
            $left -= $right;
        } else {
            $right -= $left;
        }
    }
    return $right;
}