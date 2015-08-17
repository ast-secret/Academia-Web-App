<?= $this->assign('title', ' - Clientes') ?>

<?php 
    $this->Html->addCrumb('Clientes', null);
    echo $this->Html->getCrumbList();
?>

<div class="row row-add-button">
    <div class="col-md-12">
        <?= $this->Html->link($this->Html->icon('plus') . ' Criar Cliente', [
            'action' => 'add'
        ], [
            'class' => 'btn btn-danger pull-right',
            'escape' => false
        ])?>  
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
    <table class="table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th style="width: 100px"><?= $this->Paginator->sort('registration', 'Matrícula') ?></th>
                <th style=""><?= $this->Paginator->sort('name', 'Nome') ?></th>
                <th style="width: 100px" class="text-center"><?= $this->Paginator->sort('status') ?></th>
                <th style="width: 100px" class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= h($customer->registration) ?></td> 
                    <td>
                        <?= h($customer->name) ?>
                        <br>
                        <?= h($customer->email) ?>
                    </td>     
                    <td class="text-center">
                        <?= $customer->is_active ? '<span class="label label-success">Ativo</span>': '<span class="label label-danger">Inativo</span>'; ?>
                    </td>      
                    <td class="text-center">
                        <?= $this->Html->link(
                                '<span class="glyphicon glyphicon-list-alt"></span>',
                                [
                                    'controller' => 'Cards',
                                    'action' => 'index',
                                    'customer_id' => $customer->id
                                ],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-default btn-xs',
                                    'title' => 'Ver fichas'
                                ])
                        ?>
                        <?= $this->Html->link(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                ['action' => 'edit', $customer->id],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-default btn-xs',
                                    'title' => 'Editar'
                                ])
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (count($customers) == 0): ?>
                <tr>
                    <td colspan="6">Nenhum cliente cadastrado ainda.</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
    
<?= $this->element('Common/paginator') ?>