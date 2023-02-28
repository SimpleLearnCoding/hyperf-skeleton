<?php


namespace Linnzh\database;


/**
 * Class MySQL
 *
 * @author  linnzh
 * @created 2023/2/28 15:26
 */
class MySQL implements DatabaseInterfece
{
    public function getUserInfo()
    {
        return ['name' => 'example'];
    }
}