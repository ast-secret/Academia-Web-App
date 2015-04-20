<?= $this->Html->script('Suggestions/index', ['inline' => false]) ?>
<?= $this->Html->script('common', ['inline' => false]) ?>
<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<form method="GET">
    <input type="hidden" value="<?= $this->request->query('tab') ?>" name="tab" id="tab">
    <input type="hidden" value="<?= $this->request->query('filters') ?>" name="filters" id="filters">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input
                    class="form-control"
                    id="q"
                    name="q"
                    placeholder="Pesquisar por nome ou texto..."
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

<ul class="nav nav-tabs">
    <li
        role="presentation"
        class="<?= $tab == 1 ? 'active' : '' ?>">
        <?=
            $this->Html->link(__('Entrada'), [
                'action' => 'index',
                '?' => ['tab' => 1]
            ])
        ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == 2 ? 'active' : '' ?>">
        <?=
            $this->Html->link(__('Com estrela'), [
                'action' => 'index',
                '?' => ['tab' => 2]
            ])
        ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == 3 ? 'active' : '' ?>">
        <?=
            $this->Html->link(__('Arquivados'), [
                'action' => 'index',
                '?' => ['tab' => 3]
            ])
        ?>    
    </li>
</ul>
<br>
<div class="table-responsive">
    <?php $urlToggleIsStar = $this->Url->build(['controller' => 'suggestions', 'action' => 'toggleIsStar']) ?>
    <?php $urlToggleIsRead = $this->Url->build(['controller' => 'suggestions', 'action' => 'toggleIsRead']) ?>
    <table
        id="table"
        class="table table-hover"
        data-url-toggle-is-read="<?= $urlToggleIsRead ?>"
        data-url-toggle-is-star="<?= $urlToggleIsStar ?>">
            <?php
                $truncatePoint = 100;
            ?>
            <?php if (count($suggestions) > 0): ?>
                <?php foreach ($suggestions as $suggestion): ?>
                    <tr data-id="<?=$suggestion->id?>">
                        <td class="text-center" style="width: 55px;">
                            <button
                                id="btn-star"
                                type="button"
                                class="btn-clean"
                                data-has-star="<?= $suggestion->is_star ?>"
                                style="cursor: pointer; margin-right: 5px">
                                <span
                                    title="<?= $suggestion->is_star ? 'Remover estrela' : 'Adicionar estrela' ?>"
                                    class="
                                        text-muted
                                        glyphicon
                                        <?= $suggestion->is_star ? 'glyphicon-star' : 'glyphicon-star-empty' ?>">
                                </span>
                            </button>
                            
                            <button
                                type="button"
                                id="btn-arquivar"
                                class="btn-clean"
                                data-is-read="<?= $suggestion->is_read ?>"
                                style="cursor: pointer">
                                <span
                                    title="<?= $suggestion->is_read ? 'Desarquivar' : 'Arquivar' ?>"
                                    class="
                                        text-muted
                                        glyphicon
                                        <?= $suggestion->is_read ? 'glyphicon-folder-close' : 'glyphicon-folder-open' ?>">
                                </span>
                            </button>
                        </td>
                        <td style="width: 150px;">
                            <?= $this->Html->link(
                                    $this->Text->truncate(h($suggestion->customer->name), 20),
                                    [
                                        'controller' => 'customers',
                                        'action' => 'view',
                                        $suggestion->customer->id
                                    ]
                                ) ?>
                        </td>
                        <td>
                            <?= $this->Html->link(h($this->Text->truncate(__($suggestion->text), $truncatePoint)), [
                                    'controller' => 'suggestions',
                                    'action' => 'view',
                                    $suggestion->id
                                ]
                            ) ?>
                        </td>
                        <td class="text-center" style="width: 130px">
                            <em class="text-muted">
                                <?= h($suggestion->created->timeAgoInWords(
                                        [
                                            'accuracy' => 'week',
                                            'format' => 'dd MMM',
                                            'end' => '+1 year'
                                        ]
                                    )) ?>
                            </em>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4"><em class="text-muted">Nenhuma sugestão.</em></td>
                </tr>
            <?php endif ?>                
    </table>
</div>
<?= $this->element('Common/paginator') ?>