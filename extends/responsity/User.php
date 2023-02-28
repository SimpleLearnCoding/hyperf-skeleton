<?php


namespace Linnzh\responsity;


use Linnzh\database\DatabaseInterfece;

/**
 * Class User
 *
 * @author  linnzh
 * @created 2023/2/28 15:27
 */
class User
{
    private DatabaseInterfece $db;

    public function __construct(DatabaseInterfece $db)
    {
        $this->db = $db;
    }

    public function getUserInfo()
    {
        return $this->db->getUserInfo();
    }
}