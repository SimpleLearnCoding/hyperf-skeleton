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
        throw new \InvalidArgumentException('Invalid Argument');
    }
    do {
        $bytes = random_bytes($length);
    } while (!$bytes);

    return $bytes;
}