<?= $this->assign('title', ' - Aulas') ?>

<?php 
    $this->Html->addCrumb('Aulas', null);
    echo $this->Html->getCrumbList();
?>

<div class="row row-add-button">
    <div class="col-md-12">
        <?= $this->Html->link('Criar Aula',
            [
                'action' => 'add'
            ],
            [
                'class' => 'btn btn-danger pull-right',
                'escape' => false
            ]
        ) ?>  
    </div>
</div>

<div class="row">
    <div class="col-md-12">
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
</div>

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

<div class="table-responsive">
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
                            <strong><?= $service->duration ?> minutos</strong> de duração, gasto calórico de <strong><?= $service->gasto_calorico ?> kcal</strong>
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
                        <?= $this->Html->link($this->Html->icon('time'),
                            [
                                'controller' => 'Services',
                                'action' => 'times',
                                'service_id' => $service->id
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
                    <td colspan="6">Nenhuma aula para exibir.</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>

<?= $this->element('Common/paginator') ?>