<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('weekday') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($weekdays as $weekday): ?>
        <tr>
            <td><?= $this->Number->format($weekday->id) ?></td>
            <td><?= $this->Number->format($weekday->weekday) ?></td>
            <td><?= h($weekday->created) ?></td>
            <td><?= h($weekday->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $weekday->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $weekday->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $weekday->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weekday->id)]) ?>
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
