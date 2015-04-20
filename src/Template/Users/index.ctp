<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Html->link('Adicionar usuário', ['action' => 'add'], ['class' => 'btn btn-danger pull-right'])?>
<br style="clear: both;">
<hr>
<table class="table table-hover table-condensed table-bordered">
<thead>
    <tr>
        <th style="width: 180px;"><?= $this->Paginator->sort('username','Email') ?></th>        
        <th><?= $this->Paginator->sort('name','Nome') ?></th>
        <th style="width: 160px;"><?= $this->Paginator->sort('role','Função') ?></th>
        <th style="width: 100px" class="text-center"><?= $this->Paginator->sort('stats','Status') ?></th>
        <th style="width: 100px" class="text-center"></th>
    </tr>
</thead>
<tbody>
    <?php foreach ($users as $user): ?>
        <tr>        
            <td><?= h($user->username) ?></td>
            <td><?= h($user->name) ?></td>
            <td><?= h($user->role->name) ?></td>
            <td class="text-center">
                <?= $this->TextBootstrap->labelBoolean($user->is_active, 'Ativo', 'Inativo') ?>
            </td>
            <td class="text-center">                
                <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
                    ['action' => 'edit', $user->id],
                    ['escape' => false, 'class' => 'btn btn-default btn-xs']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<?= $this->element('Common/paginator') ?>
