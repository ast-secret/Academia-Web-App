<?= $this->assign('title', ' - Caixa de sugestões') ?>

<?= $this->Html->script('Suggestions/index', ['inline' => false]) ?>
<?= $this->Html->script('common', ['inline' => false]) ?>

<br>
<?php 
    $this->Html->addCrumb('Sugestões', null);
    echo $this->Html->getCrumbList();
?>
<br>

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
        <?= $this->Html->link(__('Entrada'), ['action' => 'index','?' => ['tab' => 1]]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == 2 ? 'active' : '' ?>">
        <?= $this->Html->link(__('Com estrela'), [ 'action' => 'index', '?' => ['tab' => 2]]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == 3 ? 'active' : '' ?>">
        <?= $this->Html->link(__('Arquivados'), ['action' => 'index', '?' => ['tab' => 3]]) ?>    
    </li>
</ul>
<br>
<div class="table-responsive">
    <?php $urlToggleIsStar = $this->Url->build([
        'controller' => 'Suggestions', 'action' => 'toggleIsStar', '_ext' => 'json'
    ]) ?>
    <?php $urlToggleIsRead = $this->Url->build([
        'controller' => 'Suggestions', 'action' => 'toggleIsRead', '_ext' => 'json'
    ]) ?>
    <table
        id="table"
        class="table table-striped"
        data-url-toggle-is-read="<?= $urlToggleIsRead ?>"
        data-url-toggle-is-star="<?= $urlToggleIsStar ?>">
        
        <tbody>
            <?php if (count($suggestions) > 0): ?>
                <?php foreach ($suggestions as $suggestion): ?>
                    <tr data-id="<?=$suggestion->id?>">
                        <td class="text-center" style="width: 55px;">
                            <button
                                id="btn-star"
                                type="button"
                                class="btn-clean"
                                data-has-star="<?= (int)$suggestion->is_star ?>"
                                style="cursor: pointer; margin-right: 5px">
                                <span
                                    title="<?= (int)$suggestion->is_star ? 'Remover estrela' : 'Adicionar estrela' ?>"
                                    class="
                                        text-muted
                                        glyphicon
                                        <?= (int)$suggestion->is_star ? 'glyphicon-star' : 'glyphicon-star-empty' ?>">
                                </span>
                            </button>
                            
                            <button
                                type="button"
                                id="btn-arquivar"
                                class="btn-clean"
                                data-is-read="<?= (int)$suggestion->is_read ?>"
                                style="cursor: pointer">
                                <span
                                    title="<?= (int)$suggestion->is_read ? 'Desarquivar' : 'Arquivar' ?>"
                                    class="
                                        text-muted
                                        glyphicon
                                        <?= (int)$suggestion->is_read ? 'glyphicon-folder-close' : 'glyphicon-folder-open' ?>">
                                </span>
                            </button>
                        </td>
                        <td style="width: 150px;">
                            <div  class="truncate-text" style="width: 149px">
                                <?= $this->Html->link(h($suggestion->customer->name), [
                                    'controller' => 'Customers',
                                    'action' => 'view',
                                    $suggestion->customer->id
                                ]) ?>
                            </div>
                        </td>
                        <td>
                            <div
                                id="suggestion-text"
                                class="truncate-text"
                                style="width: 10px;">

                                <?= $this->Html->link(h($suggestion->text), [
                                    'controller' => 'Suggestions',
                                    'action' => 'view',
                                    $suggestion->id
                                ]) ?>
                            </div>
                        </td>
                        <td class="text-center" style="width: 200px">
                            <em class="text-muted">
                                <?= h($suggestion->created->timeAgoInWords([
                                    'accuracy' => 'month',
                                    'format' => 'dd MMM',
                                    'end' => '+1 year'
                                ])) ?>
                            </em>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4"><em class="text-muted">Nenhuma sugestão.</em></td>
                </tr>
            <?php endif ?>    
        </tbody>            
    </table>
</div>
<?= $this->element('Common/paginator') ?>