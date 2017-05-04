<?php
/**
 * Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="actions columns large-2 medium-3">
    <h3><?= __d('CakeDC/Users', 'Actions') ?></h3>
    <ul class="menu vertical">
        <li><?= $this->Html->link(__d('CakeDC/Users', 'New {0}', $tableAlias), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="users index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('email', __d('CakeDC/Users', 'Email')) ?></th>
            <th><?= $this->Paginator->sort('role', __d('CakeDC/Users', 'Role')) ?></th>
            <th><?= $this->Paginator->sort('active', __d('CakeDC/Users', 'Active')) ?></th>
            <th class="actions"><?= __d('CakeDC/Users', 'Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (${$tableAlias} as $user) : ?>
            <tr>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->active) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__d('CakeDC/Users', 'View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__d('CakeDC/Users', 'Change password'), ['action' => 'changePassword', $user->id]) ?>
                    <?= $this->Html->link(__d('CakeDC/Users', 'Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__d('CakeDC/Users', 'Delete'), ['action' => 'delete', $user->id], ['confirm' => __d('CakeDC/Users', 'Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination text-center">
            <?= $this->Paginator->prev('< ' . __d('CakeDC/Users', 'previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('CakeDC/Users', 'next') . ' >') ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter() ?></p>
    </div>
</div>
