<?= $this->Html->link('Adicionar usuário', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table">
<thead>
    <tr>        
        <th><?= $this->Paginator->sort('name','Nome') ?></th>
        <th><?= $this->Paginator->sort('username','Login') ?></th>        
        <th><?= $this->Paginator->sort('role','Função') ?></th>
        <th><?= $this->Paginator->sort('stats','Status') ?></th>
        <th class="actions"><?= __('Ações') ?></th>
    </tr>
</thead>
<tbody>
<?php foreach ($users as $user): ?>
    <tr>        
        <td><?= h($user->name) ?></td>
        <td><?= h($user->username) ?></td>        
        <td><?= h($user->role->name) ?></td>
        <td><?= $user->stats ? '<span class="label label-success">Ativo</span>': '<span class="label label-danger">Inativo</span>' ?></td>
        <td class="actions">                
            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id]) ?>            
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
