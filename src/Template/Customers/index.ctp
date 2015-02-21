<?= $this->Html->link('Adicionar Aluno', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Nome') ?></th>
            <th><?= $this->Paginator->sort('Nº de Registro') ?></th>
            <th><?= $this->Paginator->sort('Chave de Acesso') ?></th>
            <th><?= $this->Paginator->sort('status','Status') ?></th>            
            <th class="actions"><?= __('Ações') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?= h($customer->name) ?></td>
            <td><?= h($customer->registration) ?></td>
            <td><?= h($customer->access_key) ?></td>
            <td><?= $customer->status ? '<span class="label label-success">Ativo</span>': '<span class="label label-danger">Inativo</span>' ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Ver'), ['action' => 'view', $customer->id]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $customer->id]) ?>
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
