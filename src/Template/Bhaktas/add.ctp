<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bhaktas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Gurus'), ['controller' => 'Gurus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gurus'), ['controller' => 'Gurus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bhaktas form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($bhakta) ?>
    <fieldset>
        <legend><?= __('Add Bhakta') ?></legend>
        <?php
            echo $this->Form->control('neme', ['label' => 'férfi']);
            echo $this->Form->control('nev_szuletesi');
            echo $this->Form->control('nev_polgari');
            echo $this->Form->control('nev_avatott');
            echo $this->Form->control('guru_id', ['options' => $gurus, 'empty' => true]);
            echo $this->Form->control('cim_allando');
            echo $this->Form->control('cim_ideiglenes');
            echo $this->Form->control('cim_szallas');
            echo $this->Form->control('szig');
            echo $this->Form->control('utlevel');
            echo $this->Form->control('adoazonosito');
            echo $this->Form->control('taj');
            echo $this->Form->control('szul_hely');
            echo $this->Form->control('szul_date', ['empty' => true]);
            echo $this->Form->control('szul_time', ['empty' => true]);
            echo $this->Form->control('allampolgarsag');
            echo $this->Form->control('katonasag');
            echo $this->Form->control('haziorvos_nev');
            echo $this->Form->control('haziorvos_cim');
            echo $this->Form->control('haziorvos_telefon');
            echo $this->Form->control('datum_elsotalalkozas');
            echo $this->Form->control('datum_elfogadas');
            echo $this->Form->control('datum_elsoavatas');
            echo $this->Form->control('datum_masodikavatas');
            echo $this->Form->control('asram_id');
            echo $this->Form->control('hazastars_id', ['empty' => true]);
            echo $this->Form->control('tb_id', ['options' => $tbs, 'empty' => true]);
            echo $this->Form->control('legalstatus_id', ['options' => $legalstatuses, 'empty' => true]);
            echo $this->Form->control('communityrole_id', ['options' => $communityroles, 'empty' => true]);
            echo $this->Form->control('vegzettseg');
            echo $this->Form->control('szakma');
            echo $this->Form->control('vegakarat');
            echo $this->Form->control('halalertesitendo');
            echo $this->Form->control('bhsastri_datum');
            echo $this->Form->control('bhsastri_eredmeny');
            echo $this->Form->control('nyelv');
            echo $this->Form->control('csalad_nev_anya');
            echo $this->Form->control('csalad_nev_apa');
            echo $this->Form->control('csalad_hozzaallas');
            echo $this->Form->control('india');
            echo $this->Form->control('rs_szerz');
            echo $this->Form->control('aktiv');
            echo $this->Form->control('bizalmas_info');
            echo $this->Form->control('megjegyzes');
            echo $this->Form->control('kep');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
