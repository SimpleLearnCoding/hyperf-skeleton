<?php

namespace encrypt;

use Linnzh\encrypt\EncryptFactory;
use Linnzh\encrypt\EncryptInterface;
use PHPUnit\Framework\TestCase;

class AesTest extends TestCase
{
    private string $iv;
    private string $key;
    private EncryptInterface $encrypt;
    private string $message;
    private string $ciphertext;

    public function testDecrypt()
    {
        $message = $this->encrypt->decrypt($this->ciphertext, $this->key);
        $this->assertEquals($this->message, $message);
    }

    public function testEncrypt()
    {
        $ciphertext = $this->encrypt->encrypt($this->message, $this->key, $this->iv);
        $this->assertEquals($this->ciphertext, $ciphertext);
    }

    protected function setUp(): void
    {
        $this->iv = hex2bin('00283ab7132b7f3e3becaf6bbce832f5');
        $this->key = '94e34375-9c3d-9e95-012b-6c0b093b7500';

        $this->encrypt = EncryptFactory::create('aes', 16);
        $this->message = 'Hello, Linnzh@github.com';
        $this->ciphertext = 'ACg6txMrfz477K9rvOgy9SWh+ytsOd9UcijWjGHIkZ3qZEsX/X2RN/Beqh/sf1kE';
    }
}
