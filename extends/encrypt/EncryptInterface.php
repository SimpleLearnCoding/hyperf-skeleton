<?php

namespace Linnzh\encrypt;


interface EncryptInterface
{
    /**
     * 加密
     *
     * @param string $message
     * @param string $key
     * @param string $iv
     *
     * @return string
     */
    public function encrypt(string $message, string $key, string $iv);

    /**
     * 解密
     *
     * @param string $ciphertext
     * @param string $key
     *
     * @return string
     */
    public function decrypt(string $ciphertext, string $key);
}