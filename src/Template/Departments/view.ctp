<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Centers'), ['controller' => 'Centers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Center'), ['controller' => 'Centers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departments view small-9 medium-10 large-10 columns content">
    <h3><?= h($department->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Center') ?></th>
            <td><?= $department->has('center') ? $this->Html->link($department->center->name, ['controller' => 'Centers', 'action' => 'view', $department->center->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($department->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($department->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('active') ?></th>
            <td><?= $department->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Services') ?></h4>
        <?php if (!empty($department->services)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Bhakta Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Szolgalat') ?></th>
                <th scope="col"><?= __('Szolgalat Kezdete') ?></th>
                <th scope="col"><?= __('Szolgalat Vege') ?></th>
                <th scope="col"><?= __('Szolg Megjegyzes') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->services as $services): ?>
            <tr>
                <td><?= h($services->id) ?></td>
                <td><?= h($services->bhakta_id) ?></td>
                <td><?= h($services->department_id) ?></td>
                <td><?= h($services->szolgalat) ?></td>
                <td><?= h($services->szolgalat_kezdete) ?></td>
                <td><?= h($services->szolgalat_vege) ?></td>
                <td><?= h($services->szolg_megjegyzes) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Services', 'action' => 'view', $services->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Services', 'action' => 'edit', $services->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Services', 'action' => 'delete', $services->id], ['confirm' => __('Are you sure you want to delete # {0}?', $services->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
