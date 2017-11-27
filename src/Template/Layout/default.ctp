<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('foundation.min.css') ?>
    <?= $this->Html->css('foundation-icons.css') ?>
    <?= $this->Html->css('noty.css') ?>
    <?= $this->Html->css('bhakta.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <nav>
        <div class="title-bar" data-responsive-toggle="navbar" data-hide-for="medium">
            <button class="menu-icon" type="button" data-toggle="navbar"></button>
            <div class="title-bar-title">Menü</div>
        </div>

        <div data-sticky-container>
            <div class="top-bar" id="navbar" data-sticky data-options="marginTop:0;" style="width:100%">
                <div class="top-bar-left">
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li class="menu-text"><?= $this->fetch('title') ?></li>
                        <?php if ($this->request->session()->read('Auth.User')) : //TODO add .active to li?>
                            <li>
                                <?= $this->Html->menuLink(
                                    '<i class="fi-torsos"></i> <span>Bhakták</span>',
                                    [
                                        'plugin' => false,
                                        'controller' => 'bhaktas',
                                        'action' => 'index'
                                    ],
                                    [
                                        'escape' => false
                                    ]
                                ) ?>
                                <ul class="nested vertical menu">
                                    <li><?= $this->Html->menuLink(
                                            '<i class="fi-torsos"></i> <span>Bhakták</span>',
                                            [
                                                'plugin' => false,
                                                'controller' => 'bhaktas',
                                                'action' => 'index'
                                            ],
                                            [
                                                'escape' => false
                                            ]
                                        ) ?></li>
                                    <li><?= $this->Html->menuLink(
                                            '<i class="fi-page-edit"></i> <span>Átírós lista</span>',
                                            ['plugin' => false, 'controller' => 'departments', 'action' => 'members'],
                                            ['escape' => false]
                                        ) ?></li>
                                    <?php if (in_array($this->request->session()->read('Auth.User.role'), ['superuser', 'admin'])) : ?>
                                        <li><?= $this->Html->menuLink(
                                                '<i class="fi-torso"></i> <span>Új bhakta</span>',
                                                ['plugin' => false, 'controller' => 'bhaktas', 'action' => 'add'],
                                                ['escape' => false]
                                            ) ?></li>
                                        <li><?= $this->Html->menuLink(
                                                '<i class="fi-megaphone"></i> <span>Szolgálat változás</span>',
                                                ['plugin' => false, 'controller' => 'services', 'action' => 'add'],
                                                ['escape' => false]
                                            ) ?></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php if ($this->request->session()->read('Auth.User.is_superuser')
                                && $this->request->session()->read('Auth.User.role') == 'superuser') : ?>
                                <li><?= $this->Html->menuLink(
                                        '<i class="fi-torso-business"></i> <span>Users</span>',
                                        ['plugin' => 'CakeDC/Users', 'controller' => 'users', 'action' => 'index'],
                                        ['escape' => false]
                                    ) ?></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="top-bar-right">
                    <ul class="menu">
                        <?php if ($this->request->session()->read('Auth.User')) : ?>
                        <li class="input-group">
                            <span class="input-group-label fi-magnifying-glass"></span>
                            <?php
                            echo $this->Form->create('bhaktas', ['url' => ['controller' => 'bhaktas', 'action' => 'index']]);
                            echo $this->Form->input(
                                'q',
                                [
                                    'label' => false,
                                    'class' => 'input-group-field',
                                    'title' => 'Keresés avatott névre, polgári névre, születési névre'
                                ]
                            );
                            echo $this->Form->end();
                            ?>
                        </li>
                        <?php endif; ?>
                        <li><?= $this->User->welcome() ?></li>
                        <li><?= $this->User->logout() ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <?= $this->Flash->render() ?>
    <div class="container clearfix row">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>

    <?= $this->Html->script('vendor/jquery.js') ?>
    <?= $this->Html->script('vendor/jquery-ui.js') ?>
    <?= $this->Html->script('vendor/noty.js') ?>
    <?= $this->Html->script('vendor/what-input.js') ?>
    <?= $this->Html->script('vendor/foundation.js') ?>
    <?= $this->Html->script('app.js') ?>
    <?= $this->fetch('script') ?>

</body>
</html>
