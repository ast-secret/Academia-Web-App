<?= $this->element('common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<?= $this->Html->link('Adicionar', ['action' => 'add'], ['class' => 'btn btn-primary pull-right'])?>

<br style="clear: both;">
<br>
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
        <?php if (count($releases) > 0): ?>
            <?php foreach ($releases as $release): ?>
                <tr>
                    <td><?= h($release->user->name) ?></td>
                    <td><?= h($release->title) ?></td>
                    <td><?= $this->Text->excerpt(h($release->text),'method',50,'...');?></td>
                    <td><?= h($release->created) ?></td>            
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $release->id]) ?>                 
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $release->id]) ?>                 
                    </td>
                </tr>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10"><em>Nenhum comunicado cadastro por enquanto.</em></td>
            </tr>
        <?php endif; ?>
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
