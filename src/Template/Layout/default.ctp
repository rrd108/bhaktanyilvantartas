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

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('bhakta.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <div class="title-area large-3 medium-4 columns">
            <h1><?= $this->fetch('title') ?></h1>
        </div>
        <div class="top-bar-section">
            <ul class="left">
                <li><?= $this->Html->link('Bhakták', ['plugin' => false, 'controller' => 'bhaktas', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link('Átírós lista', ['plugin' => false, 'controller' => 'departments', 'action' => 'members']) ?></li>
                <?php if (in_array($this->request->session()->read('Auth.User.role'), ['superuser', 'admin'])) : ?>
                    <li><?= $this->Html->link('Új bhakta', ['plugin' => false, 'controller' => 'bhaktas', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('Szolgálat változás', ['plugin' => false, 'controller' => 'services', 'action' => 'add']) ?></li>
                <?php endif; ?>
                <?php if ($this->request->session()->read('Auth.User.is_superuser')
                    && $this->request->session()->read('Auth.User.role') == 'superuser') : ?>
                    <li><?= $this->Html->link('Users', ['plugin' => 'CakeDC/Users', 'controller' => 'users', 'action' => 'index']) ?></li>
                <?php endif; ?>
            </ul>
            <ul class="right">
                <li><?= $this->User->welcome() ?></li>
                <li><?= $this->User->logout() ?></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
