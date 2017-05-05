<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $gurus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $gurus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Gurus'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="gurus form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($gurus) ?>
    <fieldset>
        <legend><?= __('Edit Gurus') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('nev_full');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
