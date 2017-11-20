<?php
/**
 * Created by PhpStorm.
 * User: mihaly
 * Date: 2017.11.17.
 * Time: 13:24
 */

namespace App\Model\Table;

use CakeDC\Users\Model\Table\UsersTable;

class MyUsersTable
{
    public function findSuperUsers()
    {
        return $this->select(['User.username','User.email'])->where(['is_sueperuser',1]);
    }
}