<?php


namespace App\Annotation\Demo;


use Attribute;

/**
 * Class DemoAnnotation
 *
 * 注解功能提供了代码中的声明部分都可以添加结构化、机器可读的元数据的能力， 注解的目标可以是类、方法、函数、参数、属性、类常量。
 * 通过 反射 API 可在运行时获取注解所定义的元数据。
 * 因此注解可以成为直接嵌入代码的配置式语言。
 *
 * 注意：这里设置的是元数据，项目启动后仅会扫描一次的元数据
 * 而非被调用时即被执行。
 *
 * 所以，注解适合用来收集或分析代码。
 *
 * 注解使用的一个简单例子：将接口（interface）的可选方法改用注解实现。
 *
 * @example 收集被标记为「可缓存」的属性、被定义的路由、被注入的依赖等
 * @author  linnzh
 * @created 2023/3/8 16:15
 *
 * @link    https://hyperf.wiki/3.0/#/zh-cn/annotation
 * @see     \Hyperf\HttpServer\Annotation\Mapping
 */
#[Attribute(Attribute::TARGET_METHOD)]
class DemoAnnotation extends \Hyperf\Di\Annotation\AbstractAnnotation
{
    public function __construct(public string $topic = 'demo')
    {
    }
}