<?= $this->Html->link('Adicionar Academia', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
<thead>
    <tr>
        <th><?= $this->Paginator->sort('id') ?></th>
        <th><?= $this->Paginator->sort('name') ?></th>
        <th><?= $this->Paginator->sort('description') ?></th>
        <th><?= $this->Paginator->sort('address') ?></th>
        <th><?= $this->Paginator->sort('cover_img') ?></th>
        <th><?= $this->Paginator->sort('logo_img') ?></th>
        <th><?= $this->Paginator->sort('created') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
</thead>
<tbody>
<?php foreach ($gyms as $gym): ?>
    <tr>
        <td><?= $this->Number->format($gym->id) ?></td>
        <td><?= h($gym->name) ?></td>
        <td><?= h($gym->description) ?></td>
        <td><?= h($gym->address) ?></td>
        <td><?= h($gym->cover_img) ?></td>
        <td><?= h($gym->logo_img) ?></td>
        <td><?= h($gym->created) ?></td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $gym->id]) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $gym->id]) ?>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $gym->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gym->id)]) ?>
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