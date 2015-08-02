<?= $this->assign('title', ' - Aulas') ?>

<?php 
    $this->Html->addCrumb('Aulas', null);
    echo $this->Html->getCrumbList();
?>
<br>

<div class="row">
    <div class="col-md-8">
        <form method="GET" class="form-inline">
            <input type="hidden" value="<?= $this->request->query('tab') ?>" name="tab" id="tab">
            <div class="form-group">
                <input
                    class="form-control"
                    id="q"
                    name="q"
                    placeholder="Pesquisar por nome..."
                    type="text"
                    value="<?= $this->request->query('q')?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default" type="button" title="Pesquisar">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>

        </form>
    </div>
    <div class="col-md-4">
        <?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Criar aula',
            [
                'action' => 'add'
            ],
            [
                'class' => 'btn btn-danger pull-right',
                'escape' => false
            ])?>  
    </div>
</div>

<br style="clear: both;">

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

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>
                <?= $this->Paginator->sort('name', 'Nome') ?> / Descrição
            </th>            
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
                <td class="text-center" style="vertical-align: middle">
                    <?php if ($service->is_active): ?>
                        <span class="label label-success">Ativo</span>
                    <?php else: ?>
                        <span class="label label-danger">Inativo</span>
                    <?php endif ?>
                </td>
                <td class="text-center" style="vertical-align: middle">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-time"></span>',
                        [
                            'controller' => 'Times',
                            'action' => 'edit',
                            $service->id
                        ],
                        [
                            'escape' => false,
                            'class' => 'btn btn-default btn-xs',
                            'title' => 'Configurar Horários'
                        ]) ?>

                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
                        ['action' => 'edit', $service->id],
                        [
                            'escape' => false,
                            'class' => 'btn btn-default btn-xs',
                            'title' => 'Editar'
                        ]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', ['action' => 'delete', $service->id], [
                        'confirm' => __('Você tem certeza que deseja deletar ?', $service->id),
                        'class' => 'btn btn-xs btn-default',
                        'escape' => false,
                        'title' => 'Deletar'
                    ]) ?>
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