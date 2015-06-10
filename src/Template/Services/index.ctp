<?= $this->assign('title', ' - Aulas') ?>


<br>
<?php 
    $this->Html->addCrumb('Aulas', null);
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Html->link('Criar aula', ['action' => 'add'], ['class' => 'btn btn-danger pull-right'])?>

<br style="clear: both;">
<br>

<form method="GET">
    <input type="hidden" value="<?= $this->request->query('tab') ?>" name="tab" id="tab">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input
                    class="form-control"
                    id="q"
                    name="q"
                    placeholder="Pesquisar por nome..."
                    type="text"
                    value="<?= $this->request->query('q')?>">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger" type="button" title="Pesquisar">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div><!-- /input-group -->  
        </div>
    </div>
</form>
<hr>

<ul class="nav nav-tabs">
    <li
        role="presentation"
        class="<?= $tab == '0' ? 'active' : '' ?>">
        <?= $this->Html->link('Ativos', ['action' => 'index','?' => ['tab' => '0']]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == '1' ? 'active' : '' ?>">
        <?= $this->Html->link('Inativos', [ 'action' => 'index', '?' => ['tab' => '1']]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == '2' ? 'active' : '' ?>">
        <?= $this->Html->link('Todos', [ 'action' => 'index', '?' => ['tab' => '2']]) ?>
    </li>
</ul>
<br>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <?= $this->Paginator->sort('name', 'Nome') ?> / Descrição
            </th>            
            <th style="width: 350px">Horários</th>
            <th style="width: 100px" class="text-center">
                <?= $this->Paginator->sort('is_active', 'Status') ?>
            </th>
            <th style="width: 100px" class="text-center"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($services as $service): ?>
            <tr>
                <td>
                    <h4><?= h($service->name) ?></h4>
                    <p class="text-muted">
                        <small><?= $service->duration ?> minutos de duração</small>
                    </p>
                    <?= h($service->description) ?>
                </td>
                <td>
                    <?php if ($service->times): ?>
                        <?php $currentDay = -1; ?>
                        <?php foreach ($service->times as $time): ?>
                            <?php if ($currentDay != $time->weekday): ?>
                                <h5>
                                    <?= $this->Weekdays->getById($time->weekday) ?>
                                    <?php $currentDay = $time->weekday ?>
                                </h5>
                            <?php endif ?>
                            <span class="label label-primary">
                                <?= $time->start_hour->format('H:i') ?>
                            </span>
                            &nbsp;
                        <?php endforeach ?>

                        <hr>    
                        <p class="text-center">
                            <?= $this->Html->link('<span class="glyphicon glyphicon-cog"></span> Configurar horários', [
                                'controller' => 'Times',
                                'action' => 'edit',
                                $service->id
                            ], [
                                'escape' => false,
                                'class' => 'btn btn-default btn-xs'
                            ]) ?>
                        </p>
                    <?php else: ?>
                        <em>Nenhum horário cadastrado</em>
                    <?php endif ?>
                </td>
                <td class="text-center">
                    <?php if ($service->is_active): ?>
                        <span class="label label-success">Ativo</span>
                    <?php else: ?>
                        <span class="label label-danger">Inativo</span>
                    <?php endif ?>
                </td>
                <td class="text-center">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
                        ['action' => 'edit', $service->id],
                        ['escape' => false, 'class' => 'btn btn-default btn-xs']) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', ['action' => 'delete', $service->id], ['confirm' => __('Você tem certeza que deseja deletar ?', $service->id), 'class' => 'btn btn-xs btn-danger', 'escape' => false]) ?>
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

<?= $this->element('Common/paginator') ?>