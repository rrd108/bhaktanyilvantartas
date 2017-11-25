<?php
/**
 * Created by PhpStorm.
 * User: mihaly
 * Date: 2017.11.17.
 * Time: 13:24
 */

namespace App\Model\Table;

use Cake\ORM\Query;
use CakeDC\Users\Model\Table\UsersTable;

class MyUsersTable extends UsersTable
{
    public function findSuperUsers(Query $query, array $options)
    {
        return $query->select(['MyUsers.username', 'MyUsers.email'])->where(['MyUsers.is_superuser', 1]);
    }
}