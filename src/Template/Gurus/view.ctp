<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Gurus'), ['action' => 'edit', $gurus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Gurus'), ['action' => 'delete', $gurus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gurus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Gurus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gurus'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="gurus view large-9 medium-8 columns content">
    <h3><?= h($gurus->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nev Rovid') ?></th>
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
