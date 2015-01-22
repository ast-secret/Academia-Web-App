<?= $this->Html->link('Adicionar Sugestão', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
    <table  class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('text') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th><?= $this->Paginator->sort('customer_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($suggestions as $suggestion): ?>
        <tr>
            <td><?= $this->Number->format($suggestion->id) ?></td>
            <td><?= h($suggestion->text) ?></td>
            <td><?= h($suggestion->created) ?></td>
            <td><?= h($suggestion->modified) ?></td>
            <td>
                <?= $suggestion->has('customer') ? $this->Html->link($suggestion->customer->name, ['controller' => 'Customers', 'action' => 'view', $suggestion->customer->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('Ver'), ['action' => 'view', $suggestion->id]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $suggestion->id]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $suggestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suggestion->id)]) ?>
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
