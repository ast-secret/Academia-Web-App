<?= $this->Html->script('../lib/niceCharCounter/dist/jquery.niceCharCounter', ['inline' => false]) ?>

<?php
	$this->Html->scriptStart(['block' => true]);
		echo "$(function(){
			$('#text').niceCharCounter({
				max: 800,
				warningPercent: 10,
				warningColor: '#e67e22',
				text: '{{residual}} caractere(s) restante(s).',
				containerText: '#container-counter',
			});
		});";
	$this->Html->scriptEnd();
?>

<?= $this->assign('title', ' - Editar comunicado') ?>

<?php 
	$this->Html->addCrumb('Comunicados', ['action' => 'index']);
    $this->Html->addCrumb('Editar comunicados');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($release, ['novalidate' => true]); ?>
    <?= $this->Form->input('text',['label' => 'Texto', 'type' => 'textarea', 'rows' => 8, 'maxlength' => false]) ?>  
    <div class="row">
    	<div class="col-md-6 col-md-offset-2">
    		<p id="container-counter" class="help-block">ds</p>		
    	</div>
    </div>
    
    <?= $this->Form->input('is_active', ['label' => 'Publicar']) ?>  
    <hr>
	<?= $this->Form->submit('Salvar Alterações', ['bootstrap-type' => 'primary', 'class' => 'pull-right']) ?>
<?= $this->Form->end() ?>