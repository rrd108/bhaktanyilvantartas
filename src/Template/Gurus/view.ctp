<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Gurus'), ['action' => 'edit', $gurus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Gurus'), ['action' => 'delete', $gurus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gurus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Gurus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gurus'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="gurus view small-9 medium-10 large-10 columns content">
    <h3><?= h($gurus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($gurus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nev Full') ?></th>
            <td><?= h($gurus->nev_full) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($gurus->id) ?></td>
        </tr>
    </table>
</div>
