<?php


namespace Linnzh\encrypt;


/**
 * Class EncryptFactory
 *
 * @author  linnzh
 * @created 2023/3/8 14:11
 */
class EncryptFactory
{
    public static function create(string $name = 'aes', int $ivLength = 16): EncryptInterface
    {
        return match ($name) {
            'aes' => new Aes(withIvLen: $ivLength, cipher: 'aes-256-cbc', options: OPENSSL_RAW_DATA),
            default => throw new \RuntimeException('Unsupport encrypt method!'),
        };
    }
}