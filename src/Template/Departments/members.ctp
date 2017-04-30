<div class="departments index large-12 medium-8 columns content">
    <h3>Bhakta lista</h3>
            <?php
                $volunteers = $missionaries = 0;
                foreach ($departments as $department):
                //debug($department);die();
                    if ($department->manpower) {
                        print '<div class="department">';
                        print '<h4>' . $department->osztaly . ' (' . $department->manpower . ')</h4>';
                        print '<ol>';
                        foreach ($department->services as $service) {
                            if ($service->bhakta->statusz_tagsag == 2) {
                                $volunteers++;
                            } elseif ($service->bhakta->statusz_tagsag == 1) {
                                $missionaries++;
                            }
                            print '<li>' .
                                $this->Html->link(
                                    '➤',
                                    [
                                        'controller' => 'bhaktas',
                                        'action' => 'edit', $service->bhakta->id
                                    ]
                                ) . ' ' .
                                ($service->bhakta->nev_avatott
                                    ? $service->bhakta->nev_avatott
                                    : $service->bhakta->nev_polgari) .
                                '</li>';
                        }
                        print '</ol>';
                        print '</div>';
                    }
                ?>
            <?php endforeach; ?>
    <?php
    print '<hr>';
    print 'Önkéntesek: ' . $volunteers . '<br>';
    print 'Missizonáriusok: ' . $missionaries;
    ?>
</div>
