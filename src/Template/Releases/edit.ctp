<?= $this->Html->script('../lib/nice-char-counter/dist/nice-char-counter', ['inline' => false]) ?>

<?php
	$this->Html->scriptStart(['block' => true]);
		echo "$(function(){
			$('#text').niceCharCounter({
                limit: 800,
                warningPercent: 10,
                warningColor: '#e67e22',
                text: '{{counter}} caractere(s) restante(s).',
                counter: '#container-counter',
			});
		});";
	$this->Html->scriptEnd();
?>

<?= $this->assign('title', ' - Editar Comunicado') ?>

<?php 
	$this->Html->addCrumb('Comunicados', ['action' => 'index']);
    $this->Html->addCrumb('Editar Comunicados');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($release, ['novalidate' => true, 'horizontal' => true]); ?>
    <?= $this->Form->input('text',['label' => 'Texto', 'type' => 'textarea', 'rows' => 8, 'maxlength' => false]) ?>  
    <div class="row">
    	<div class="col-md-6 col-md-offset-2">
    		<p id="container-counter" class="help-block"></p>		
    	</div>
    </div>
    
    <?= $this->Form->input('is_active', ['label' => 'Publicar']) ?>  
    <hr>
	<?= $this->Form->submit('Salvar Alterações') ?>
<?= $this->Form->end() ?>