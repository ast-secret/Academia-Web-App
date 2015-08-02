<?= $this->Html->script('../lib/nice-char-counter/dist/nice-char-counter', ['inline' => false]) ?>

<?php
	$this->Html->scriptStart(['block' => true]);
		echo "$(function(){
			$('#text').niceCharCounter({
				limit: 800,
				warningPercent: 98,
				warningColor: '#e67e22',
				text: '{{counter}} caracte[r, res] restant[e,es].',
				counter: '#container-counter',
			});
		});";
	$this->Html->scriptEnd();
?>

<?= $this->assign('title', ' - Criar comunicado') ?>

<?php 
	$this->Html->addCrumb('Comunicados', ['action' => 'index']);
    $this->Html->addCrumb('Criar comunicados');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($release, ['horizontal' => true, 'novalidate' => true]); ?>
    <?= $this->Form->input('text',['label' => 'Texto', 'type' => 'textarea', 'rows' => 8, 'maxlength' => false]) ?>  
    <div class="row">
    	<div class="col-md-6 col-md-offset-2">
    		<p id="container-counter" class="help-block">ds</p>		
    	</div>
    </div>
    
    <?= $this->Form->input('is_active', ['label' => 'Publicar']) ?>  
    <hr>
	<?= $this->Form->submit('Criar Comunicado', ['bootstrap-type' => 'primary', 'class' => 'pull-right']) ?>
<?= $this->Form->end() ?>