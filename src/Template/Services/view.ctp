<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Service'), ['action' => 'edit', $service->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Service'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bhaktas'), ['controller' => 'Bhaktas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bhakta'), ['controller' => 'Bhaktas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="services view large-9 medium-8 columns content">
    <h3><?= h($service->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Bhakta') ?></th>
            <td><?= $service->has('bhakta') ? $this->Html->link($service->bhakta->id, ['controller' => 'Bhaktas', 'action' => 'view', $service->bhakta->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= 'Szolgálat' ?></th>
            <td><?= h($service->szolgalat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Szolg Megjegyzes') ?></th>
            <td><?= h($service->szolg_megjegyzes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($service->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Osztaly Id') ?></th>
            <td><?= $this->Number->format($service->department_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Szolgalat Kezdete') ?></th>
            <td><?= h($service->szolgalat_kezdete) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Szolgalat Vege') ?></th>
            <td><?= h($service->szolgalat_vege) ?></td>
        </tr>
    </table>
</div>
