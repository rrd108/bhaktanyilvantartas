<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Services'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Bhaktas'), ['controller' => 'Bhaktas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bhakta'), ['controller' => 'Bhaktas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="services form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($service) ?>
    <fieldset>
        <legend><?= __('Add Service') ?></legend>
        <?php
            echo $this->Form->control('bhakta_id', ['options' => $bhaktas, 'empty' => true]);
            echo $this->Form->control('department_id', ['options' => $departments, 'empty' => true]);
            echo $this->Form->control('szolgalat');
            echo $this->Form->control('szolgalat_kezdete', ['empty' => true]);
            echo $this->Form->control('szolgalat_vege', ['empty' => true]);
            echo $this->Form->control('szolg_megjegyzes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
