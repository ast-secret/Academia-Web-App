<?= $this->Html->link('Adicionar Comunicado', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
    <table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('user_id','Usuário') ?></th>
            <th><?= $this->Paginator->sort('title','Titulo') ?></th>
            <th><?= $this->Paginator->sort('text','Texto') ?></th>
            <th><?= $this->Paginator->sort('created','Criado em') ?></th>
            <th class="actions"><?= __('Ações') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($releases as $release): ?>
        <tr>
            <td>
                <?= $release->has('user') ? $this->Html->link($release->user->name, ['controller' => 'Users', 'action' => 'view', $release->user->id]) : '' ?>
            </td>
            <td><?= h($release->title) ?></td>
            <td><?= h($release->text) ?></td>
            <td><?= h($release->created) ?></td>            
            <td class="actions">
                <?= $this->Html->link(__('Ver'), ['action' => 'view', $release->id]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $release->id]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $release->id], ['confirm' => __('Você tem certeza que deseja deletar?', $release->id)]) ?>
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
