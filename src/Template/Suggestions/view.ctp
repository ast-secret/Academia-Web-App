<?= $this->Html->script('Suggestions/view', ['inline' => false]) ?>

<br>
<?php 
	$this->Html->addCrumb('Sugestões', ['action' => 'index']);
    $this->Html->addCrumb('Visualização de sugestão', null);
    echo $this->Html->getCrumbList();
?>
<br>

<div class="row">
	<div class="col-md-8">
		<?= $this->Html->link(h($suggestion->customer->name), ['controller' => 'Customers', 'action' => 'view', $suggestion->customer->id]) ?>
		<br>
		<small>
			<em class="text-muted">
				<?= $suggestion->created->timeAgoInWords(['format' => 'dd/MMM/Y', 'accuracy' => 'days', 'end' => '+1 month']) ?>
			</em>
		</small>		
	</div>
    <?php $urlToggleIsStar = $this->Url->build([
    	'controller' => 'Suggestions', 'action' => 'toggleIsStar', '_ext' => 'json'
    ]) ?>
    <?php $urlToggleIsRead = $this->Url->build([
    	'controller' => 'Suggestions', 'action' => 'toggleIsRead', '_ext' => 'json'
    ]) ?>
	<div
		class="col-md-4 text-right"
		data-suggestion-id="<?= $suggestion->id ?>"
		data-url-toggle-is-read="<?= $urlToggleIsRead ?>"
		data-url-toggle-is-star="<?= $urlToggleIsStar ?>">
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
	</div>
</div>

<br>

<div class="row" style="margin-top: 15px;">
    <div class="col-md-6 col-md-offset-3 text-center">
        <p>
            <?= h($suggestion->text) ?>
        </p>
    </div>
</div>
