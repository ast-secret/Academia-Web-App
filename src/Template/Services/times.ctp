<?= $this->assign('title', ' - Aulas') ?>

<?php 
    $this->Html->addCrumb('Aulas', ['action' => 'index']);
    $this->Html->addCrumb("Horários de <strong>{$service->name}</strong>", null);
    echo $this->Html->getCrumbList();
?>

<br>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 180px;">
                    Dia da semana
                </th>            
                <th>
                    Horários de início
                </th>
                <th style="width: 50px"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->Weekdays->getAll() as $weekday): ?>
                <tr>
                    <td>
                        <?= $weekday['name'] ?>
                    </td>
                    <td>
                        <?php if (isset($timesById[$weekday['id']])): ?>
                            <?php foreach ($timesById[$weekday['id']] as $time): ?>
                                <span class="label label-primary">
                                    <?= $time->start_hour->format('H:i') ?>
                                </span>&nbsp;
                            <?php endforeach ?>
                        <?php else: ?>
                            <small class="text-muted">
                                <em>Nenhum horário para exibir.</em>
                            </small>
                        <?php endif ?>
                    </td>
                    <td class="text-center">
                        <?= $this->Html->link($this->Html->icon('pencil'), [
                                'action' => 'timesEdit',
                                'service_id' => $service->id,
                                'weekday' => $weekday['id']
                            ], [
                            'escape' => false,
                            'class' => 'btn btn-default btn-xs'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>