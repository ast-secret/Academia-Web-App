<?= $this->Html->link('Adicionar Ficha', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
<thead>
    <tr>
        <th><?= $this->Paginator->sort('id') ?></th>
        <th><?= $this->Paginator->sort('user_id') ?></th>
        <th><?= $this->Paginator->sort('start_date') ?></th>
        <th><?= $this->Paginator->sort('end_date') ?></th>
        <th><?= $this->Paginator->sort('goal') ?></th>
        <th><?= $this->Paginator->sort('created') ?></th>
        <th><?= $this->Paginator->sort('modified') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
</thead>
<tbody>
<?php foreach ($cards as $card): ?>
    <tr>
        <td><?= $this->Number->format($card->id) ?></td>
        <td>
            <?= $card->has('user') ? $this->Html->link($card->user->name, ['controller' => 'Users', 'action' => 'view', $card->user->id]) : '' ?>
        </td>
        <td><?= h($card->start_date) ?></td>
        <td><?= h($card->end_date) ?></td>
        <td><?= h($card->goal) ?></td>
        <td><?= h($card->created) ?></td>
        <td><?= h($card->modified) ?></td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $card->id]) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $card->id]) ?>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $card->id], ['confirm' => __('Are you sure you want to delete # {0}?', $card->id)]) ?>
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
