<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bhakta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Gurus'), ['controller' => 'Gurus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gurus'), ['controller' => 'Gurus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bhaktas index large-9 medium-8 columns content">
    <h3><?= __('Bhaktas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('neme') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nev_szuletesi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nev_polgari') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nev_avatott') ?></th>
                <th scope="col"><?= $this->Paginator->sort('guru_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cim_allando') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cim_ideiglenes') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cim_szallas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szig') ?></th>
                <th scope="col"><?= $this->Paginator->sort('utlevel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adoazonosito') ?></th>
                <th scope="col"><?= $this->Paginator->sort('taj') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szul_hely') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szul_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szul_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('allampolgarsag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('katonasag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('haziorvos_nev') ?></th>
                <th scope="col"><?= $this->Paginator->sort('haziorvos_cim') ?></th>
                <th scope="col"><?= $this->Paginator->sort('haziorvos_telefon') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datum_elsotalalkozas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datum_elfogadas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datum_elsoavatas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datum_masodikavatas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asram') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hazastars_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('statusz_jogi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('statusz_tagsag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vegzettseg') ?></th>
                <th scope="col"><?= $this->Paginator->sort('szakma') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vegakarat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('halalertesitendo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bhsastri_datum') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bhsastri_eredmeny') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nyelv') ?></th>
                <th scope="col"><?= $this->Paginator->sort('csalad_nev_anya') ?></th>
                <th scope="col"><?= $this->Paginator->sort('csalad_nev_apa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('csalad_hozzaallas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('india') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rs_szerz') ?></th>
                <th scope="col"><?= $this->Paginator->sort('aktiv') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kep') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bhaktas as $bhakta): ?>
            <tr>
                <td><?= $this->Number->format($bhakta->id) ?></td>
                <td><?= h($bhakta->neme) ?></td>
                <td><?= h($bhakta->nev_szuletesi) ?></td>
                <td><?= h($bhakta->nev_polgari) ?></td>
                <td><?= h($bhakta->nev_avatott) ?></td>
                <td><?= $bhakta->has('gurus') ? $this->Html->link($bhakta->gurus->id, ['controller' => 'Gurus', 'action' => 'view', $bhakta->gurus->id]) : '' ?></td>
                <td><?= h($bhakta->cim_allando) ?></td>
                <td><?= h($bhakta->cim_ideiglenes) ?></td>
                <td><?= h($bhakta->cim_szallas) ?></td>
                <td><?= h($bhakta->szig) ?></td>
                <td><?= h($bhakta->utlevel) ?></td>
                <td><?= h($bhakta->adoazonosito) ?></td>
                <td><?= h($bhakta->taj) ?></td>
                <td><?= h($bhakta->szul_hely) ?></td>
                <td><?= h($bhakta->szul_date) ?></td>
                <td><?= h($bhakta->szul_time) ?></td>
                <td><?= h($bhakta->allampolgarsag) ?></td>
                <td><?= $this->Number->format($bhakta->katonasag) ?></td>
                <td><?= h($bhakta->haziorvos_nev) ?></td>
                <td><?= h($bhakta->haziorvos_cim) ?></td>
                <td><?= h($bhakta->haziorvos_telefon) ?></td>
                <td><?= h($bhakta->datum_elsotalalkozas) ?></td>
                <td><?= h($bhakta->datum_elfogadas) ?></td>
                <td><?= h($bhakta->datum_elsoavatas) ?></td>
                <td><?= h($bhakta->datum_masodikavatas) ?></td>
                <td><?= $this->Number->format($bhakta->asram) ?></td>
                <td><?= $this->Number->format($bhakta->hazastars_id) ?></td>
                <td><?= h($bhakta->tb) ?></td>
                <td><?= h($bhakta->statusz_jogi) ?></td>
                <td><?= h($bhakta->statusz_tagsag) ?></td>
                <td><?= h($bhakta->vegzettseg) ?></td>
                <td><?= h($bhakta->szakma) ?></td>
                <td><?= h($bhakta->vegakarat) ?></td>
                <td><?= h($bhakta->halalertesitendo) ?></td>
                <td><?= h($bhakta->bhsastri_datum) ?></td>
                <td><?= h($bhakta->bhsastri_eredmeny) ?></td>
                <td><?= h($bhakta->nyelv) ?></td>
                <td><?= h($bhakta->csalad_nev_anya) ?></td>
                <td><?= h($bhakta->csalad_nev_apa) ?></td>
                <td><?= h($bhakta->csalad_hozzaallas) ?></td>
                <td><?= h($bhakta->india) ?></td>
                <td><?= h($bhakta->rs_szerz) ?></td>
                <td><?= h($bhakta->aktiv) ?></td>
                <td><?= h($bhakta->kep) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bhakta->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bhakta->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bhakta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bhakta->id)]) ?>
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
