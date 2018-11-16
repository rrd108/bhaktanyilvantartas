<div class="bhaktas form small-9 medium-10 large-10 columns content">
    <h3><?= __('Volunteers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('nev_avatott') ?></th>
            <th scope="col"><?= $this->Paginator->sort('nev_polgari') ?></th>
            <th scope="col"><?= $this->Paginator->sort('service.start') ?></th>
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
                <td><?= h($bhakta['service']['start']) ?></td>
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

