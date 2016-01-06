<?= $this->assign('title', ' - Editar Exercício') ?>

<?php 
	$this->Html->addCrumb('Exercícios', ['action' => 'index']);
    $this->Html->addCrumb('Editar exercício');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($exercisesSuggestion, ['horizontal' => true, 'novalidate' => true]); ?>
    <?php
        echo $this->Form->input('name', ['label' => 'Nome', 'autocomplete' => 'off']);
        echo $this->Form->hidden('is_active', ['value' => 1]);
    ?>
    <hr>
    <?= $this->Form->submit('Editar Exercício') ?>
<?= $this->Form->end() ?>
