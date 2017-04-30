<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $gurus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $gurus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Gurus'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="gurus form large-9 medium-8 columns content">
    <?= $this->Form->create($gurus) ?>
    <fieldset>
        <legend><?= __('Edit Gurus') ?></legend>
        <?php
            echo $this->Form->control('nev_rovid');
            echo $this->Form->control('nev_full');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
