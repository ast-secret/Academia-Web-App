<?= $this->Html->link('Adicionar aula', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('name', 'Nome') ?></th>            
            <th><?= $this->Paginator->sort('description', 'Descrição') ?></th>
            <th>Horários</th>
            <th class="actions"><?= __('Ações') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($services as $service): ?>
        <tr>
            <td><?= h($service->name) ?></td>           
            <td><?= h($service->description) ?></td>
            <td>
                <?php if ($service->times): ?>
                    <?php foreach ($service->times as $time): ?>
                        <span class="label label-primary"><?= $time->start_hour ?></span>
                    <?php endforeach ?>
                <?php endif ?>
            </td> 
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
