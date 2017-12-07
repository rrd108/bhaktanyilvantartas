<?php
/**
 * Created by PhpStorm.
 * User: mihaly
 * Date: 2017.12.01.
 * Time: 8:54
 */

namespace App\Controller;


class AppUsersController
{
    use LoginTrait;
    use RegisterTrait;
    use ProfileTrait;
    use SimpleCrudTrait;

    public function edit(){
        die("edit");
    }
}