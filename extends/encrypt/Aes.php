<?php


namespace Linnzh\encrypt;


/**
 * AES 算法 - 默认支持 CBC 算法（并推荐使用）
 *
 * openssl_encrypt 和 openssl_decrypt 的第三个参数是options，它有着很重要的作用：
 *
 * 0：默认模式，自动进行 pkcs7 补位，同时自动进行 base64 编码
 *
 * 1：OPENSSL_RAW_DATA，自动进行 pkcs7 补位， 但是不自动进行 base64 编码
 *
 * 2：OPENSSL_ZERO_PADDING，需要自己进行 pkcs7 补位，同时自动进行 base64 编码
 *
 * ======================================================================
 *
 * 在 openssl 版本里的 AES-256-CBC 方法对应 mcrypt 版本里的 AES-128-CBC
 *
 * ======================================================================
 *
 * @link https://www.php.net/manual/en/function.openssl-get-cipher-methods
 */
class Aes implements EncryptInterface
{
    protected int $ivlen = 16;

    /**
     *
     * @param int    $withIvLen
     * @param string $cipher
     * @param int    $options
     *
     * @example new Aes(cipher: 'aes-128-ecb')
     * @example new Aes(cipher: 'aes-192-ecb')
     * @example new Aes(cipher: 'aes-256-ecb')
     * @example new Aes(cipher: 'aes-128-cbc')
     * @example new Aes(cipher: 'aes-192-cbc')
     * @example new Aes(cipher: 'aes-256-cbc')
     */
    public function __construct(public int $withIvLen = 16, protected string $cipher = 'aes-256-cbc', public int $options = OPENSSL_RAW_DATA)
    {
        $this->setCipher($cipher);
        $this->ivlen = openssl_cipher_iv_length(strtoupper($this->cipher));
    }

    private function setCipher(string $cipher)
    {
        if (!in_array($cipher, [
            'aes-128-ecb',
            'aes-192-ecb',
            'aes-256-ecb',
            'aes-128-cbc',
            'aes-192-cbc',
            'aes-256-cbc',
        ], true)) {
            throw new \UnexpectedValueException('Unsupported encryption algorithm!');
        }
        $this->cipher = $cipher;
    }

    /**
     * 加密
     *
     * @param string $message
     * @param string $key
     * @param string $iv
     *
     * @return string
     */
    public function encrypt(string $message, string $key, string $iv)
    {
        if (empty($iv)) {
            throw new \ParseError('The initialization vector is not allowed to be empty!');
        }

        $iv = substr($iv, 0, $this->ivlen);

        try {
            $ciphertext = openssl_encrypt($message, $this->cipher, $key, $this->options, $iv);
            // 携带 iv
            $ciphertext = $iv . $ciphertext;

            if ($this->options == OPENSSL_RAW_DATA) {
                $ciphertext = base64_encode($ciphertext);
            }

            return $ciphertext;
        } catch (\Throwable $e) {
            // throw new \ParseError('Encrypt failed!');
        }

        throw new \ParseError('Encrypt failed!');
    }

    /**
     * 解密
     *
     * @param string $ciphertext
     * @param string $key
     *
     * @return string
     */
    public function decrypt(string $ciphertext, string $key)
    {
        if ($this->options == OPENSSL_RAW_DATA) {
            $ciphertext = base64_decode($ciphertext);
        }

        $iv = substr($ciphertext, 0, $this->withIvLen);
        $ciphertext = substr($ciphertext, $this->withIvLen);

        try {
            return openssl_decrypt($ciphertext, $this->cipher, $key, $this->options, $iv);
        } catch (\Throwable $e) {
        }

        throw new \ParseError('Decrypt failed!');
    }
}