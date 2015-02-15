<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Html->link('Adicionar aula', ['action' => 'add'], ['class' => 'btn btn-danger pull-right'])?>
<br style="clear: both;">
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('name', 'Nome') ?></th>            
            <th><?= $this->Paginator->sort('description', 'Descrição') ?></th>
            <th>Horários</th>
            <td>Status</td>
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
                <?php else: ?>
                    <em>Nenhum horário cadastrado</em>
                <?php endif ?>
            </td>
            <td>
                <?php if ($service->stats): ?>
                    <span class="label label-success">Ativo</span>
                <?php else: ?>
                    <span class="label label-danger">Inativo</span>
                <?php endif ?>
            </td>
            <td class="actions">
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
