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
use Cake\Core\Configure;

$Users = ${$tableAlias};
?>
<div class="actions columns large-2 medium-3">
    <h3><?= __d('CakeDC/Users', 'Actions') ?></h3>
    <ul class="menu vertical">
        <li>
            <?php
            echo $this->Form->postLink(
                __d('CakeDC/Users', 'Delete'),
                ['action' => 'delete', $Users->id],
                ['confirm' => __d('CakeDC/Users', 'Are you sure you want to delete # {0}?', $Users->id)]
            );
            ?>
        </li>
        <li><?= $this->Html->link(__d('CakeDC/Users', 'List Users'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($Users); ?>
    <fieldset>
        <legend><?= __d('CakeDC/Users', 'Edit User') ?></legend>
        <?php
        echo $this->Form->control('username', ['label' => __d('CakeDC/Users', 'Username')]);
        echo $this->Form->control('email', ['label' => __d('CakeDC/Users', 'Email')]);
        if($Users->role == 'user'){
            echo $this->Form->control('role',['label' => __d('CakeDC/Users', 'Role'),'options' => ['user', 'superuser']]);
        }
        if($Users->role == 'superuser'){
            echo $this->Form->control('role',['label' => __d('CakeDC/Users', 'Role'), 'options' => ['superuser', 'user']]);
        }
        echo $this->Form->control('active', [
            'label' => __d('CakeDC/Users', 'Active')
        ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__d('CakeDC/Users', 'Submit'),['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
