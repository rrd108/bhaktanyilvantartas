<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Service'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bhaktas'), ['controller' => 'Bhaktas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bhakta'), ['controller' => 'Bhaktas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="services index large-9 medium-8 columns content">
    <h3><?= __('Services') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bhakta_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('osztaly_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szolgalat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szolgalat_kezdete') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szolgalat_vege') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szolg_megjegyzes') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
            <tr>
                <td><?= $this->Number->format($service->id) ?></td>
                <td><?= $service->has('bhakta') ? $this->Html->link($service->bhakta->nev_avatott, ['controller' => 'Bhaktas', 'action' => 'view', $service->bhakta->id]) : '' ?></td>
                <td><?= h($service->department->osztaly) ?></td>
                <td><?= h($service->szolgalat) ?></td>
                <td><?= h($service->szolgalat_kezdete) ?></td>
                <td><?= h($service->szolgalat_vege) ?></td>
                <td><?= h($service->szolg_megjegyzes) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $service->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $service->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
