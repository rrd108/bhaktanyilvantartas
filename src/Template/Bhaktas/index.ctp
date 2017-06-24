<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bhakta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Gurus'), ['controller' => 'Gurus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gurus'), ['controller' => 'Gurus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bhaktas index small-9 medium-10 large-10 columns content">
    <h3><?= __('Bhaktas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nev_avatott') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nev_polgari') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cim_allando') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adoazonosito') ?></th>
                <th scope="col"><?= $this->Paginator->sort('taj') ?></th>
            </tr>
            <tr>
                <th scope="col"></th>
                <th scope="col"><?= $this->Paginator->sort('szul_hely') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szul_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('csalad_nev_anya') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bhaktas as $bhakta): ?>
            <tr>
                <td class="nowrap <?= ($bhakta->neme ? 'fi-torso' : 'fi-torso-female')?>">
                    <strong>
                        <?= $this->Html->link(h($bhakta->nev_avatott), ['action' => 'view', $bhakta->id]) ?>
                    </strong>
                </td>
                <td><?= h($bhakta->nev_polgari) ?></td>
                <td><?= h($bhakta->cim_allando) ?></td>
                <td><?= h($bhakta->adoazonosito) ?></td>
                <td><?= h($bhakta->taj) ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= h($bhakta->szul_hely) ?></td>
                <td><?= h($bhakta->szul_date) ?></td>
                <td><?= h($bhakta->csalad_nev_anya) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bhakta->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bhakta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bhakta->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination text-center">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
