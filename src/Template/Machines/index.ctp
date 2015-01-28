<div class="machines index large-10 medium-9 columns">
    <table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('gym_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($machines as $machine): ?>
        <tr>
            <td><?= $this->Number->format($machine->id) ?></td>
            <td>
                <?= $machine->has('gym') ? $this->Html->link($machine->gym->name, ['controller' => 'Gyms', 'action' => 'view', $machine->gym->id]) : '' ?>
            </td>
            <td><?= h($machine->name) ?></td>
            <td><?= h($machine->created) ?></td>
            <td><?= h($machine->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $machine->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $machine->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $machine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $machine->id)]) ?>
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
