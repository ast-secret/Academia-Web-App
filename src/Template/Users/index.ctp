<?= $this->Html->link('Adicionar usuário', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table">
<thead>
    <tr>
        <th><?= $this->Paginator->sort('id') ?></th>
        <th><?= $this->Paginator->sort('gym_id') ?></th>
        <th><?= $this->Paginator->sort('role_id') ?></th>
        <th><?= $this->Paginator->sort('name') ?></th>
        <th><?= $this->Paginator->sort('username') ?></th>
        <th><?= $this->Paginator->sort('password') ?></th>
        <th><?= $this->Paginator->sort('role') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
</thead>
<tbody>
<?php foreach ($users as $user): ?>
    <tr>
        <td><?= $this->Number->format($user->id) ?></td>
        <td>
            <?= $user->has('gym') ? $this->Html->link($user->gym->name, ['controller' => 'Gyms', 'action' => 'view', $user->gym->id]) : '' ?>
        </td>
        <td>
            <?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?>
        </td>
        <td><?= h($user->name) ?></td>
        <td><?= h($user->username) ?></td>
        <td><?= h($user->password) ?></td>
        <td><?= $this->Number->format($user->role) ?></td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
