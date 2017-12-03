<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AppUser Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \App\Model\Entity\Bhakta[] $bhaktas
 */
use CakeDC\Users\Model\Entity\User;

class AppUser extends User
{

}
