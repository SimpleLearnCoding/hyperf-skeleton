<?php


namespace Linnzh\Ioc;


/**
 * Class Container
 *
 * @author  linnzh
 * @created 2023/2/28 15:21
 */
class Container
{
    private array $services = [];

    public function register($name, $callback)
    {
        if (is_callable($callback)) {
            $this->services[$name] = $callback;
        } else {
            throw new \RuntimeException('Invalid callback');
        }
    }

    public function get($name)
    {
        if (isset($this->services[$name])) {  // 如果服务存在，则调用回调函数来实例化服务对象并返回结果。
            return call_user_func($this->services[$name]);
        }

        throw new \RuntimeException('Service not found');
    }
}