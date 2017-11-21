<?php
echo $this->Html->script('departments.members.js', ['block' => true]);
?>
<div class="departments index large-12 medium-8 column content">
    <h3>Bhakta lista</h3>
    <div class="row">
        <?php
        $volunteers = $missionaries = 0;
        foreach ($departments as $department):
            //debug($department);die();
            if ($department->manpower) : ?>
                <div class="small-4 column">
                    <div class="department">
                        <h4><?= $department->name . ' (' . $department->manpower . ')' ?></h4>
                        <ol id="ol-<?= $department->id ?>">
                            <?php foreach ($department->services as $service) : ?>
                                <?php if ($service->bhakta->communityrole_id == 2) {
                                    $volunteers++;
                                } elseif ($service->bhakta->communityrole_id == 1) {
                                    $missionaries++;
                                } ?>
                                <li id="li-<?= $service->bhakta_id ?>">
                                    <?php
                                    //if service started recently
                                    $icon = '';
                                    if ($service->szolgalat_kezdete->wasWithinLast('1 months')
                                        || $service->szolgalat_kezdete->isWithinNext('2 weeks')) {
                                        $icon = ' ✩';
                                    }
                                    ?>
                                    <?= $this->Html->link(
                                        ($service->bhakta->communityrole_id == 1) ? '✔' : '➤',
                                        [
                                            'controller' => 'bhaktas',
                                            'action' => 'edit',
                                            $service->bhakta->id
                                        ]
                                    ) . ' ' .
                                    ($service->bhakta->nev_avatott
                                        ? $service->bhakta->nev_avatott
                                        : $service->bhakta->nev_polgari) .
                                    $icon . ' '; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <p class="departments-total row">
        <?= $volunteers . ' önkéntes, ' .
            $missionaries . ' misszionárius, ' .
            'Összesen: ' . ($volunteers + $missionaries);
        ?>
    </p>
</div>
