<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Html->link('Criar comunicado', ['action' => 'add'], ['class' => 'btn btn-danger pull-right'])?>
<br style="clear: both;">
<hr>
<table class="table table-hover table-condensed table-bordered">    
    <thead>
        <tr>
            <th style="width: 250px;"><?= $this->Paginator->sort('title','Titulo') ?></th>
            <th><?= $this->Paginator->sort('text','Texto') ?></th>
            <th style="width: 150px"><?= $this->Paginator->sort('created','Dt. da publicação') ?></th>
            <th style="width: 100px" class="text-center">Status</th>
            <th style="width: 80px"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($releases) > 0): ?>
            <?php foreach ($releases as $release): ?>
                <tr>
                    <td><?= h($release->title) ?></td>
                    <td><?= $this->Text->excerpt(h($release->text),'method', 50, '...');?></td>
                    <td><?= h($release->created->format('d/m/y \à\s h:i')) ?></td>            
                    <td class="text-center">
                        <?= $this->TextBootstrap->labelBoolean($release->status, 'Ativo', 'Inativo') ?>
                    </td>
                    <td class="text-center">
                        <?= $this->Html->link(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                ['action' => 'edit', $release->id],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-default btn-xs',
                                    'title' => 'Editar'
                                ])
                        ?>
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

    <?= $this->element('Common/paginator') ?>

</div>
