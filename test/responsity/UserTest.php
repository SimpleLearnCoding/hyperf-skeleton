<?php

namespace HyperfTest\responsity;

use Linnzh\database\MySQL;
use Linnzh\Ioc\Container;
use Linnzh\responsity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetUserInfo()
    {
        // 定义IoC容器
        $container = new Container();

        // 注册服务
        $container->register('db', function () {
            return new MySQL();
        });

        // 使用服务
        $user = new User($container->get('db'));
        $info = $user->getUserInfo();
        
        $this->assertIsArray($info);
        $this->assertArrayHasKey('name', $info);
    }
}
