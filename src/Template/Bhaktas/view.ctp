<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bhakta'), ['action' => 'edit', $bhakta->id]) ?> </li>
        <li><?= $this->Html->link(__('List Bhaktas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bhakta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Gurus'), ['controller' => 'Gurus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gurus'), ['controller' => 'Gurus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
    </ul>
    <?php if ($bhakta->kep != null): ?>
        <img src="<?= $imageURL ?>" alt="">
    <?php endif; ?>
</nav>
<div class="bhaktas view small-9 medium-10 large-10 columns content">
<div class="bhaktas view small-9 medium-10 large-10 columns content">
    <h3><?= h($bhakta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nev Szuletesi') ?></th>
            <td><?= h($bhakta->nev_szuletesi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nev Polgari') ?></th>
            <td><?= h($bhakta->nev_polgari) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nev Avatott') ?></th>
            <td><?= h($bhakta->nev_avatott) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gurus') ?></th>
            <td><?= $bhakta->has('gurus') ? $this->Html->link($bhakta->gurus->name,
                    ['controller' => 'Gurus', 'action' => 'view', $bhakta->gurus->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cim Allando') ?></th>
            <td><?= h($bhakta->cim_allando) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cim Ideiglenes') ?></th>
            <td><?= h($bhakta->cim_ideiglenes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cim Szallas') ?></th>
            <td><?= h($bhakta->cim_szallas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Szig') ?></th>
            <td><?= h($bhakta->szig) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Utlevel') ?></th>
            <td><?= h($bhakta->utlevel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adoazonosito') ?></th>
            <td><?= h($bhakta->adoazonosito) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Taj') ?></th>
            <td><?= h($bhakta->taj) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Szul Hely') ?></th>
            <td><?= h($bhakta->szul_hely) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Allampolgarsag') ?></th>
            <td><?= h($bhakta->allampolgarsag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Haziorvos Nev') ?></th>
            <td><?= h($bhakta->haziorvos_nev) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Haziorvos Cim') ?></th>
            <td><?= h($bhakta->haziorvos_cim) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Haziorvos Telefon') ?></th>
            <td><?= h($bhakta->haziorvos_telefon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datum Elsotalalkozas') ?></th>
            <td><?= h($bhakta->datum_elsotalalkozas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datum Elfogadas') ?></th>
            <td><?= h($bhakta->datum_elfogadas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datum Elsoavatas') ?></th>
            <td><?= h($bhakta->datum_elsoavatas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datum Masodikavatas') ?></th>
            <td><?= h($bhakta->datum_masodikavatas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tb') ?></th>
            <td><?= h($bhakta->tb->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= 'EU egészségbiztosítás' ?></th>
            <td><?= $bhakta->eu_card_expiry; ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Statusz Jogi') ?></th>
            <td><?php
                if ($bhakta->legalstatus_id != null) {
                    echo h($bhakta->legalstatus->name);
                } ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Statusz Tagsag') ?></th>
            <td><?= h($bhakta->communityrole->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vegzettseg') ?></th>
            <td><?= h($bhakta->vegzettseg) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Szakma') ?></th>
            <td><?= h($bhakta->szakma) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vegakarat') ?></th>
            <td><?= h($bhakta->vegakarat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Halalertesitendo') ?></th>
            <td><?= h($bhakta->halalertesitendo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bhsastri Datum') ?></th>
            <td><?= h($bhakta->bhsastri_datum) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bhsastri Eredmeny') ?></th>
            <td><?= h($bhakta->bhsastri_eredmeny) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nyelv') ?></th>
            <td><?= h($bhakta->nyelv) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Csalad Nev Anya') ?></th>
            <td><?= h($bhakta->csalad_nev_anya) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Csalad Nev Apa') ?></th>
            <td><?= h($bhakta->csalad_nev_apa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Csalad Hozzaallas') ?></th>
            <td><?= h($bhakta->csalad_hozzaallas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('India') ?></th>
            <td><?= h($bhakta->india) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rs Szerz') ?></th>
            <td><?= h($bhakta->rs_szerz) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kep') ?></th>
            <td><?= h($bhakta->kep) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Katonasag') ?></th>
            <td><?= $this->Number->format($bhakta->katonasag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('asram_id') ?></th>
            <td><?= h($bhakta->asram->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hazastars Id') ?></th>
            <td><?= $this->Number->format($bhakta->hazastars_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Szul Date') ?></th>
            <td><?= h($bhakta->szul_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Szul Time') ?></th>
            <td><?= h($bhakta->szul_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= 'Férfi' ?></th>
            <td><?= $bhakta->neme ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('active') ?></th>
            <td><?= $bhakta->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <?php if (in_array($this->request->session()->read('Auth.User.role'), ['superuser', 'igazgato'])) : ?>
        <div class="row">
            <h4><?= __('Bizalmas Info') ?></h4>
            <?= $this->Text->autoParagraph(h($bhakta->bizalmas_info)); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <h4><?= __('Megjegyzes') ?></h4>
        <?= $this->Text->autoParagraph(h($bhakta->megjegyzes)); ?>
    </div>
    <div class="related">
        <h4><?= 'Szolgálati történet' ?></h4>
        <?php if (!empty($bhakta->services)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= 'Osztály' ?></th>
                    <th scope="col"><?= 'Szolgálat' ?></th>
                    <th scope="col"><?= __('Szolgalat Kezdete') ?></th>
                    <th scope="col"><?= __('Szolgalat Vege') ?></th>
                    <th scope="col"><?= __('Szolg Megjegyzes') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($bhakta->services as $services): ?>
                    <tr>
                        <td><?= h($services->department->center->name) ?> / <?= h($services->department->name) ?></td>
                        <td><?= h($services->szolgalat) ?></td>
                        <td><?= h($services->szolgalat_kezdete) ?></td>
                        <td><?= h($services->szolgalat_vege) ?></td>
                        <td><?= h($services->szolg_megjegyzes) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'),
                                ['controller' => 'Services', 'action' => 'view', $services->id]) ?>
                            <?= $this->Html->link(__('Edit'),
                                ['controller' => 'Services', 'action' => 'edit', $services->id]) ?>
                            <?= $this->Form->postLink(__('Delete'),
                                ['controller' => 'Services', 'action' => 'delete', $services->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $services->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
