<div class="departments index large-12 medium-8 column content">
    <h3>Bhakta lista</h3>
    <div class="row">
            <?php
                $volunteers = $missionaries = 0;
                foreach ($departments as $department):
                //debug($department);die();
                    if ($department->manpower) {
                        print '<div class="small-4 column">';
                            print '<div class="department">';
                                print '<h4>' . $department->name . ' (' . $department->manpower . ')</h4>';
                                print '<ol>';
                                foreach ($department->services as $service) {
                                    if ($service->bhakta->communityrole_id == 2) {
                                        $volunteers++;
                                    } elseif ($service->bhakta->communityrole_id == 1) {
                                        $missionaries++;
                                    }
                                    print '<li>';
                                    //if service started recently
                                    $icon = '';
                                    if ($service->szolgalat_kezdete->wasWithinLast('1 months')
                                        || $service->szolgalat_kezdete->isWithinNext('2 weeks')) {
                                        $icon = ' ✩';
                                    }
                                    print $this->Html->link(
                                            '➤',
                                            [
                                                'controller' => 'bhaktas',
                                                'action' => 'edit', $service->bhakta->id
                                            ]
                                        ) . ' ' .
                                        ($service->bhakta->nev_avatott
                                            ? $service->bhakta->nev_avatott
                                            : $service->bhakta->nev_polgari) .
                                            $icon .
                                        '</li>';
                                }
                                print '</ol>';
                            print '</div>';
                        print '</div>';
                    }
                ?>
            <?php endforeach; ?>
    </div>
    <p class="departments-total row">
        <?php
        print $volunteers . ' önkéntes, ' .
            $missionaries . ' missizonárius, ' .
            'Összesen: ' . ($volunteers+$missionaries);
        ?>
    </p>
</div>
