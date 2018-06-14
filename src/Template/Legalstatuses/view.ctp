<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Legalstatus'), ['action' => 'edit', $legalstatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Legalstatus'), ['action' => 'delete', $legalstatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $legalstatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Legalstatuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Legalstatus'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bhaktas'), ['controller' => 'Bhaktas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bhakta'), ['controller' => 'Bhaktas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="legalstatuses view small-9 medium-10 large-10 columns content">
    <h3><?= h($legalstatus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($legalstatus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($legalstatus->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bhaktas') ?></h4>
        <?php if (!empty($legalstatus->bhaktas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= 'Férfi' ?></th>
                <th scope="col"><?= __('Nev Szuletesi') ?></th>
                <th scope="col"><?= __('Nev Polgari') ?></th>
                <th scope="col"><?= __('Nev Avatott') ?></th>
                <th scope="col"><?= __('Guru Id') ?></th>
                <th scope="col"><?= __('Cim Allando') ?></th>
                <th scope="col"><?= __('Cim Ideiglenes') ?></th>
                <th scope="col"><?= __('Cim Szallas') ?></th>
                <th scope="col"><?= __('Szig') ?></th>
                <th scope="col"><?= __('Utlevel') ?></th>
                <th scope="col"><?= __('Adoazonosito') ?></th>
                <th scope="col"><?= __('Taj') ?></th>
                <th scope="col"><?= __('Szul Hely') ?></th>
                <th scope="col"><?= __('Szul Date') ?></th>
                <th scope="col"><?= __('Szul Time') ?></th>
                <th scope="col"><?= __('Allampolgarsag') ?></th>
                <th scope="col"><?= __('Katonasag') ?></th>
                <th scope="col"><?= __('Haziorvos Nev') ?></th>
                <th scope="col"><?= __('Haziorvos Cim') ?></th>
                <th scope="col"><?= __('Haziorvos Telefon') ?></th>
                <th scope="col"><?= __('Datum Elsotalalkozas') ?></th>
                <th scope="col"><?= __('Datum Elfogadas') ?></th>
                <th scope="col"><?= __('Datum Elsoavatas') ?></th>
                <th scope="col"><?= __('Datum Masodikavatas') ?></th>
                <th scope="col"><?= __('Asram Id') ?></th>
                <th scope="col"><?= __('Hazastars Id') ?></th>
                <th scope="col"><?= __('Tb Id') ?></th>
                <th scope="col"><?= __('Eu Card Expiry') ?></th>
                <th scope="col"><?= __('Legalstatus Id') ?></th>
                <th scope="col"><?= __('Communityrole Id') ?></th>
                <th scope="col"><?= __('Vegzettseg') ?></th>
                <th scope="col"><?= __('Szakma') ?></th>
                <th scope="col"><?= __('Vegakarat') ?></th>
                <th scope="col"><?= __('Halalertesitendo') ?></th>
                <th scope="col"><?= __('Bhsastri Datum') ?></th>
                <th scope="col"><?= __('Bhsastri Eredmeny') ?></th>
                <th scope="col"><?= __('Nyelv') ?></th>
                <th scope="col"><?= __('Csalad Nev Anya') ?></th>
                <th scope="col"><?= __('Csalad Nev Apa') ?></th>
                <th scope="col"><?= __('Csalad Hozzaallas') ?></th>
                <th scope="col"><?= __('India') ?></th>
                <th scope="col"><?= __('Rs Szerz') ?></th>
                <th scope="col"><?= __('active') ?></th>
                <th scope="col"><?= __('Bizalmas Info') ?></th>
                <th scope="col"><?= __('Megjegyzes') ?></th>
                <th scope="col"><?= __('Kep') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($legalstatus->bhaktas as $bhaktas): ?>
            <tr>
                <td><?= h($bhaktas->id) ?></td>
                <td><?= h($bhaktas->neme) ?></td>
                <td><?= h($bhaktas->nev_szuletesi) ?></td>
                <td><?= h($bhaktas->nev_polgari) ?></td>
                <td><?= h($bhaktas->nev_avatott) ?></td>
                <td><?= h($bhaktas->guru_id) ?></td>
                <td><?= h($bhaktas->cim_allando) ?></td>
                <td><?= h($bhaktas->cim_ideiglenes) ?></td>
                <td><?= h($bhaktas->cim_szallas) ?></td>
                <td><?= h($bhaktas->szig) ?></td>
                <td><?= h($bhaktas->utlevel) ?></td>
                <td><?= h($bhaktas->adoazonosito) ?></td>
                <td><?= h($bhaktas->taj) ?></td>
                <td><?= h($bhaktas->szul_hely) ?></td>
                <td><?= h($bhaktas->szul_date) ?></td>
                <td><?= h($bhaktas->szul_time) ?></td>
                <td><?= h($bhaktas->allampolgarsag) ?></td>
                <td><?= h($bhaktas->katonasag) ?></td>
                <td><?= h($bhaktas->haziorvos_nev) ?></td>
                <td><?= h($bhaktas->haziorvos_cim) ?></td>
                <td><?= h($bhaktas->haziorvos_telefon) ?></td>
                <td><?= h($bhaktas->datum_elsotalalkozas) ?></td>
                <td><?= h($bhaktas->datum_elfogadas) ?></td>
                <td><?= h($bhaktas->datum_elsoavatas) ?></td>
                <td><?= h($bhaktas->datum_masodikavatas) ?></td>
                <td><?= h($bhaktas->asram_id) ?></td>
                <td><?= h($bhaktas->hazastars_id) ?></td>
                <td><?= h($bhaktas->tb_id) ?></td>
                <td><?= h($bhaktas->eu_card_expiry) ?></td>
                <td><?= h($bhaktas->legalstatus_id) ?></td>
                <td><?= h($bhaktas->communityrole_id) ?></td>
                <td><?= h($bhaktas->vegzettseg) ?></td>
                <td><?= h($bhaktas->szakma) ?></td>
                <td><?= h($bhaktas->vegakarat) ?></td>
                <td><?= h($bhaktas->halalertesitendo) ?></td>
                <td><?= h($bhaktas->bhsastri_datum) ?></td>
                <td><?= h($bhaktas->bhsastri_eredmeny) ?></td>
                <td><?= h($bhaktas->nyelv) ?></td>
                <td><?= h($bhaktas->csalad_nev_anya) ?></td>
                <td><?= h($bhaktas->csalad_nev_apa) ?></td>
                <td><?= h($bhaktas->csalad_hozzaallas) ?></td>
                <td><?= h($bhaktas->india) ?></td>
                <td><?= h($bhaktas->rs_szerz) ?></td>
                <td><?= h($bhaktas->active) ?></td>
                <td><?= h($bhaktas->bizalmas_info) ?></td>
                <td><?= h($bhaktas->megjegyzes) ?></td>
                <td><?= h($bhaktas->kep) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bhaktas', 'action' => 'view', $bhaktas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bhaktas', 'action' => 'edit', $bhaktas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bhaktas', 'action' => 'delete', $bhaktas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bhaktas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
