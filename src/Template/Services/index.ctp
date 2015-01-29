<?= $this->Html->link('Adicionar Serviço', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('name', 'Nome') ?></th>            
            <th><?= $this->Paginator->sort('created', 'Criado em') ?></th>            
            <th class="actions"><?= __('Ações') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($services as $service): ?>
        <tr>
            <td><?= h($service->name) ?></td>           
            <td><?= h($service->created) ?></td>            
            <td class="actions">
                <?= $this->Html->link(__('Ver'), ['action' => 'view', $service->id]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $service->id]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $service->id], ['confirm' => __('Você tem certeza que deseja deletar ?', $service->id)]) ?>
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
