<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Html->link('Criar comunicado', ['action' => 'add'], ['class' => 'btn btn-danger pull-right'])?>
<br style="clear: both;">


<form method="GET">
    <input type="hidden" value="<?= $this->request->query('filters') ?>" name="filters" id="filters">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input
                    class="form-control"
                    id="q"
                    name="q"
                    placeholder="Pesquisar pelo texto..."
                    type="text"
                    value="<?= $this->request->query('q')?>">
                <span class="input-group-btn">
                    <button
                        class="btn btn-default <?= $this->request->query('filters') ? 'active': '' ?>"
                        type="button" title="Refinar Busca" id="toggle-filters">
                        <span class="glyphicon glyphicon-filter"></span>
                    </button>
                    <button type="submit" class="btn btn-danger" type="button" title="Pesquisar">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div><!-- /input-group -->  
        </div>
    </div>

    <div id="cont-filters" style="margin-top: 15px; display: <?= $this->request->query('filters') ? '': 'none' ?>">
        <div class="">
              <div class="form-vertical">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="sr-" for="exampleInputAmount">De</label>
                            <input
                                class="form-control input-sm"
                                id="from"
                                name="from"
                                placeholder="De"
                                type="date"
                                value="<?= $this->request->query('from') ?>">
                        </div>        
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="sr-" for="exampleInputAmount">Até</label>
                            <input
                                class="form-control input-sm" 
                                id="to"
                                name="to"
                                type="date"
                                value="<?= $this->request->query('to') ?>">
                        </div>  
                    </div>
                </div>
            </div> 
        </div>
    </div>
</form>
<hr>

<br>

<table class="table table-hover">
    <tbody>
        <?php if (count($releases) > 0): ?>
            <?php foreach ($releases as $release): ?>
                <tr>
                    <td>
                        <?= $this->Html->link(
                            h($release->user->name),
                                [
                                    'controller' => 'users',
                                    'action' => 'view',
                                    $release->user->id],
                                [
                                    'escape' => true,
                                    'title' => $release->user->name
                                ])
                        ?>
                        <br>
                        <em class="text-muted">
                            <?= $this->Time->timeAgoInWords(
                                $release->created,
                                [
                                    'format' => 'dd MMM',
                                    'end' => '+1 week'
                                ]
                            ) ?>
                        </em>
                        <p class="text-align: justify; text-justify: inter-word;">
                            <?= $this->Text->truncate(h($release->text), 800)?>
                        </p>
                    </td>
                    <td class="text-center">
                        <?= $this->TextBootstrap->labelBoolean($release->is_active, 'Publicado', 'Não Publicado') ?>
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
