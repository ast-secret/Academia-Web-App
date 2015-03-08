<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Html->link('Adicionar aula', ['action' => 'add'], ['class' => 'btn btn-danger pull-right'])?>
<br style="clear: both;">
<hr>
<table class="table table-hover table-condensed table-bordered">
    <thead>
        <tr>
            <th style="width: 250px"><?= $this->Paginator->sort('name', 'Nome') ?></th>            
            <th><?= $this->Paginator->sort('description', 'Descrição') ?></th>
            <th style="width: 350px">Horários</th>
            <th style="width: 100px" class="text-center">Status</th>
            <th style="width: 100px" class="text-center"></th>
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
                            <?= $this->Weekdays->getById($time->weekday_id, $weekdays) ?>
                            <span class="label label-primary"><?= $time->start_hour->format('H:i') ?></span>
                        <?php endforeach ?>
                    <?php else: ?>
                        <em>Nenhum horário cadastrado</em>
                    <?php endif ?>
                </td>
                <td class="text-center">
                    <?php if ($service->stats): ?>
                        <span class="label label-success">Ativo</span>
                    <?php else: ?>
                        <span class="label label-danger">Inativo</span>
                    <?php endif ?>
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
                            ['action' => 'edit', $service->id],
                            ['escape' => false, 'class' => 'btn btn-default btn-xs']) ?>
                        <?= $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', ['action' => 'delete', $service->id], ['confirm' => __('Você tem certeza que deseja deletar ?', $service->id), 'class' => 'btn btn-xs btn-danger', 'escape' => false]) ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($services) == 0): ?>
            <tr>
                <td colspan="6">Nenhuma aula cadastrada ainda.</td>
            </tr>
        <?php endif ?>
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
