<?= $this->Html->link('Adicionar Sala', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('name','Nome') ?></th>
            <th><?= $this->Paginator->sort('description','Descrição') ?></th>
            <th><?= $this->Paginator->sort('created','Criado em') ?></th>
            <th class="actions"><?= __('Ações') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= h($room->name) ?></td>            
            <td><?= h($room->description) ?></td>
            <td><?= h($room->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $room->id]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $room->id], ['confirm' => __('Você tem certeza que deseja deletar essa Sala ?', $room->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Próximo') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
