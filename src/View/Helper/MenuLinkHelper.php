<?php
namespace App\View\Helper;

use Cake\View\Helper\HtmlHelper;

class MenuLinkHelper extends HtmlHelper
{
    public function menuLink($title, $url = null, array $options = [])
    {
        return parent::link($title, $url, $options);
    }
}
