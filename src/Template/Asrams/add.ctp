<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Asrams'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bhaktas'), ['controller' => 'Bhaktas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bhakta'), ['controller' => 'Bhaktas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="asrams form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($asram) ?>
    <fieldset>
        <legend><?= __('Add Asram') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
