<?= $this->Html->link('Adicionar Comunicado', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
    <table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th><?= $this->Paginator->sort('text') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($releases as $release): ?>
        <tr>
            <td><?= $this->Number->format($release->id) ?></td>
            <td>
                <?= $release->has('user') ? $this->Html->link($release->user->name, ['controller' => 'Users', 'action' => 'view', $release->user->id]) : '' ?>
            </td>
            <td><?= h($release->title) ?></td>
            <td><?= h($release->text) ?></td>
            <td><?= h($release->created) ?></td>
            <td><?= h($release->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $release->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $release->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $release->id], ['confirm' => __('Are you sure you want to delete # {0}?', $release->id)]) ?>
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
