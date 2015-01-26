<?= $this->Html->link('Adicionar Serviço', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('gym_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('begin_service') ?></th>
            <th><?= $this->Paginator->sort('end_service') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($services as $service): ?>
        <tr>
            <td><?= $this->Number->format($service->id) ?></td>
            <td>
                <?= $service->has('gym') ? $this->Html->link($service->gym->name, ['controller' => 'Gyms', 'action' => 'view', $service->gym->id]) : '' ?>
            </td>
            <td><?= h($service->name) ?></td>
            <td><?= h($service->begin_service) ?></td>
            <td><?= h($service->end_service) ?></td>
            <td><?= h($service->created) ?></td>
            <td><?= h($service->modified) ?></td>
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
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
