<?= $this->assign('title', ' - Usuários') ?>

<?php 
    $this->Html->addCrumb('Usuários');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Html->link($this->Html->icon('plus') . ' Criar usuário',
    [
        'action' => 'add'
    ],
    [
        'class' => 'btn btn-danger pull-right',
        'escape' => false
    ]
) ?>

<br style="clear: both;">

<ul class="nav nav-tabs">
    <li
        role="presentation"
        class="<?= $tab == 'ativos' ? 'active' : '' ?>">
        <?= $this->Html->link('Ativos', ['action' => 'index','?' => ['tab' => 'ativos']]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == 'inativos' ? 'active' : '' ?>">
        <?= $this->Html->link('Inativos', [ 'action' => 'index', '?' => ['tab' => 'inativos']]) ?>
    </li>
</ul>

<br>

<table class="table table-striped">
<thead>
    <tr>
        <th style="width: 180px;"><?= $this->Paginator->sort('username','Email') ?></th>        
        <th><?= $this->Paginator->sort('name','Nome') ?></th>
        <th style="width: 160px;" class="text-center">
            <?= $this->Paginator->sort('role','Função') ?>
        </th>
        <th style="width: 100px" class="text-center">
            Status
        </th>
        <th style="width: 100px" class="text-center"></th>
    </tr>
</thead>
<tbody>
    <?php foreach ($users as $user): ?>
        <tr>        
            <td><?= h($user->username) ?></td>
            <td><?= h($user->name) ?></td>
            <td class="text-center">
                <?= $this->Html->label(h($user->role->name), 'primary') ?>
            </td>
            <td class="text-center">
                <?= $this->TextBootstrap->labelBoolean($user->is_active, 'Ativo', 'Inativo') ?>
            </td>
            <td class="text-center">                
                <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
                    ['action' => 'edit', $user->id],
                    [
                        'escape' => false,
                        'class' => 'btn btn-default btn-xs',
                        'title' => 'Editar'
                    ]
                ) ?>
                <?php if ($tab == 'inativos'): ?>
                    <?= $this->Form->postLink($this->Html->icon('remove'),
                        ['action' => 'delete', $user->id],
                        [
                            'escape' => false,
                            'title' => 'Deletar',
                            'class' => 'btn btn-default btn-xs',
                            'confirm' => 'Você realmente deseja deletar este usuário? Esta ação não poderá ser desfeita.'
                        ]
                    ) ?>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<?= $this->element('Common/paginator') ?>
